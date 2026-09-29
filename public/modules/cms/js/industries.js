(function () {
    'use strict';
    var search = document.getElementById('industry-search');
    if (!search) return;
    var tiles = Array.from(document.querySelectorAll('[data-industry-search]'));
    var results = document.getElementById('industry-results');
    var empty = document.getElementById('industry-empty');
    var singular = search.dataset.singular || 'industry';
    var plural = search.dataset.plural || 'industries';

    function filterIndustries() {
        var terms = search.value.trim().toLowerCase().split(/\s+/).filter(Boolean);
        var count = 0;
        tiles.forEach(function (tile) {
            var matches = terms.every(function (term) {
                return tile.dataset.industrySearch.includes(term);
            });
            tile.hidden = !matches;
            if (matches) count++;
        });
        results.textContent = count + ' ' + (count === 1 ? singular : plural) + (terms.length ? ' found' : '');
        empty.hidden = count !== 0;
    }

    search.addEventListener('input', filterIndustries);
    document.getElementById('industry-reset').addEventListener('click', function () {
        search.value = '';
        filterIndustries();
        search.focus();
    });
})();
