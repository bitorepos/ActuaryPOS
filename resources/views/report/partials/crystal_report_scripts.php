
<script>
    (function () {
        var zoom = 1;
        var zoomLabel = document.getElementById('zoomLabel');
        var pages = Array.prototype.slice.call(document.querySelectorAll('.cr-sheet'));
        var totalPages = pages.length;
        var pageInput = document.getElementById('pageInput');

        function applyZoom() {
            pages.forEach(function (p) { p.style.zoom = zoom; });
            zoomLabel.textContent = Math.round(zoom * 100) + '%';
        }
        function setZoom(z) {
            zoom = Math.min(2.5, Math.max(0.4, z));
            applyZoom();
        }

        document.getElementById('zoomIn').addEventListener('click', function () { setZoom(zoom + 0.1); });
        document.getElementById('zoomOut').addEventListener('click', function () { setZoom(zoom - 0.1); });
        document.getElementById('zoomReset').addEventListener('click', function () { setZoom(1); });

        function fitWidth() {
            if (!pages.length) return;
            var avail = window.innerWidth - 60;
            var sheetW = pages[0].offsetWidth;
            if (sheetW > avail) {
                setZoom(avail / sheetW);
            } else {
                setZoom(1);
            }
        }

        function goToPage(n) {
            n = Math.min(totalPages, Math.max(1, n));
            var target = document.getElementById('crPage' + n);
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                pageInput.value = n;
            }
        }
        document.getElementById('prevPage').addEventListener('click', function () {
            goToPage((parseInt(pageInput.value) || 1) - 1);
        });
        document.getElementById('nextPage').addEventListener('click', function () {
            goToPage((parseInt(pageInput.value) || 1) + 1);
        });
        pageInput.addEventListener('change', function () {
            goToPage(parseInt(pageInput.value) || 1);
        });

        var ticking = false;
        window.addEventListener('scroll', function () {
            if (ticking) return;
            ticking = true;
            window.requestAnimationFrame(function () {
                var mid = window.scrollY + (window.innerHeight / 2);
                var current = 1;
                for (var i = 0; i < pages.length; i++) {
                    if (pages[i].offsetTop <= mid) current = i + 1;
                }
                if (document.activeElement !== pageInput) {
                    pageInput.value = current;
                }
                ticking = false;
            });
        });

        document.getElementById('printBtn').addEventListener('click', function () { window.print(); });
        document.getElementById('closeBtn').addEventListener('click', function () { window.close(); });

        window.addEventListener('load', fitWidth);
    })();
</script>
