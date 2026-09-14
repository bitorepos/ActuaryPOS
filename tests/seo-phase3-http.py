"""Read-only HTTP smoke test against a running local Laravel server.

Usage: python tests/seo-phase3-http.py http://localhost:8765
"""
import json
import sys
import urllib.error
import urllib.request
from html.parser import HTMLParser
from pathlib import Path
from urllib.parse import urlparse


class Links(HTMLParser):
    def __init__(self):
        super().__init__()
        self.docs = set()

    def handle_starttag(self, tag, attrs):
        href = dict(attrs).get('href', '')
        if tag == 'a' and urlparse(href).path.startswith('/docs/'):
            self.docs.add(urlparse(href).path)


base = sys.argv[1].rstrip('/')
root = Path(__file__).resolve().parents[1]
pages = json.loads((root / 'modules/Cms/Resources/content/landing-pages.json').read_text(encoding='utf-8'))
results = {}
docs = set()
for path in ['features', 'industries'] + list(pages) + ['sitemap.xml']:
    with urllib.request.urlopen(base + '/' + path, timeout=30) as response:
        assert response.status == 200, path
        assert urlparse(response.url).path == '/' + path, 'Unexpected redirect: ' + path
        body = response.read().decode()
        results[path] = response.status
        parser = Links()
        parser.feed(body)
        docs.update(parser.docs)
for path in sorted(docs):
    with urllib.request.urlopen(base + path, timeout=30) as response:
        assert response.status == 200, path
        results[path] = response.status
with urllib.request.urlopen(base + '/docs-fetch-page?slug=module-repair-guide', timeout=30) as response:
    data = json.load(response)
    assert '/features/repair-management' in data['content'], 'Missing AJAX backlink'
    assert '/features/manufacturing' not in data['content'], 'Stale AJAX backlink'
for path in ['features/missing', 'industries/missing', 'features/unverified-module']:
    try:
        urllib.request.urlopen(base + '/' + path, timeout=30)
        raise AssertionError('Expected 404: ' + path)
    except urllib.error.HTTPError as error:
        assert error.code == 404, path
        results[path] = error.code
print(json.dumps({'http': results, 'documentation_ajax': 'passed'}, indent=2))
