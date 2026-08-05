<script type="text/javascript">
	$(document).ready(function(){
	    getDocAndNoteIndexPage();
	    var docusNoteModal = $('.docus_note_modal');
	    if (docusNoteModal.length && docusNoteModal.parent().get(0).tagName.toLowerCase() !== 'body') {
	        docusNoteModal.appendTo('body');
	    }
	    setTimeout(() => {
	        initializeDocumentAndNoteDataTable();
	        // Refresh footer if Documents & Notes tab is active
	        var activeTab = document.querySelector('.nav-tabs .nav-link.active');
	        if (activeTab && activeTab.getAttribute('href') === '#documents_and_notes_tab' && typeof window.contactViewFooterSetTab === 'function') {
	            window.contactViewFooterSetTab('documents_and_notes_tab');
	        }
	    }, 200);
	});
</script>
