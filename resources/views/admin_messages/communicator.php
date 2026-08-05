

<?php $__env->startSection('title', 'Admin Communicator'); ?>

<?php $__env->startSection('content'); ?>
<style>
:root {
    --comm-primary: #4f46e5;
    --comm-radius: 8px;
}
.comm-wrapper {
    display: flex;
    height: calc(100vh - 70px);
    background: #f8f9fa;
    overflow: hidden;
}

/* ── Thread List Panel ──────────────────────────────── */
.comm-threads-panel {
    width: 380px;
    flex-shrink: 0;
    background: #fff;
    border-right: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
}
.comm-threads-header {
    padding: 16px 18px;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.comm-threads-header h4 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 8px;
}
.comm-threads-header h4 i { color: var(--comm-primary); }

.comm-filter-tabs {
    display: flex;
    gap: 6px;
}
.comm-filter-tab {
    padding: 4px 12px;
    border-radius: 14px;
    font-size: .75rem;
    font-weight: 600;
    border: 1px solid #e5e7eb;
    background: #fff;
    color: #6b7280;
    cursor: pointer;
    transition: all .2s;
}
.comm-filter-tab:hover { background: #f3f4f6; }
.comm-filter-tab.active {
    background: var(--comm-primary);
    color: #fff;
    border-color: var(--comm-primary);
}

.comm-threads-list {
    flex: 1;
    overflow-y: auto;
}

.comm-thread-item {
    padding: 12px 18px;
    border-bottom: 1px solid #f3f4f6;
    cursor: pointer;
    transition: background .15s;
}
.comm-thread-item:hover { background: #f8f9fa; }
.comm-thread-item.active { background: #eff6ff; border-left: 3px solid var(--comm-primary); }
.comm-thread-item.has-unread { font-weight: 600; }

.comm-thread-subject {
    font-size: .875rem;
    font-weight: 600;
    color: #1f2937;
    margin-bottom: 2px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.comm-thread-preview {
    font-size: .78rem;
    color: #9ca3af;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}
.comm-thread-meta {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-top: 4px;
    font-size: .7rem;
    color: #9ca3af;
}
.comm-thread-meta .comm-sender { font-weight: 500; color: #6b7280; }
.comm-thread-badges { display: flex; gap: 5px; }
.comm-badge {
    font-size: .6rem;
    font-weight: 600;
    padding: 1px 7px;
    border-radius: 8px;
    text-transform: uppercase;
    letter-spacing: .3px;
}
.comm-badge-open { background: #dbeafe; color: #1d4ed8; }
.comm-badge-replied { background: #d1fae5; color: #065f46; }
.comm-badge-closed { background: #e5e7eb; color: #6b7280; }
.comm-badge-unread { background: #fef3c7; color: #92400e; }

.comm-threads-empty {
    text-align: center;
    padding: 40px 20px;
    color: #9ca3af;
}
.comm-threads-empty i { font-size: 2.5rem; margin-bottom: 10px; display: block; }
.comm-threads-loading {
    text-align: center;
    padding: 40px;
}

/* ── Messages Panel ─────────────────────────────────── */
.comm-messages-panel {
    flex: 1;
    display: flex;
    flex-direction: column;
    min-width: 0;
}
.comm-msg-header {
    padding: 14px 20px;
    background: #fff;
    border-bottom: 1px solid #e5e7eb;
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.comm-msg-header-info h5 {
    margin: 0;
    font-size: 1rem;
    font-weight: 600;
}
.comm-msg-header-info .comm-msg-sender-info {
    font-size: .78rem;
    color: #9ca3af;
}
.comm-msg-actions {
    display: flex;
    gap: 8px;
}
.comm-action-btn {
    padding: 6px 14px;
    border-radius: var(--comm-radius);
    font-size: .78rem;
    font-weight: 600;
    border: 1px solid #e5e7eb;
    background: #fff;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: all .2s;
}
.comm-action-btn:hover { background: #f3f4f6; }
.comm-action-btn.btn-close-thread { color: #dc2626; border-color: #fecaca; }
.comm-action-btn.btn-close-thread:hover { background: #fee2e2; }

.comm-msg-list {
    flex: 1;
    overflow-y: auto;
    padding: 20px;
}

.comm-message {
    margin-bottom: 16px;
    max-width: 75%;
}
.comm-message.msg-user { margin-right: auto; }
.comm-message.msg-admin { margin-left: auto; }

.comm-msg-bubble {
    padding: 10px 16px;
    border-radius: 12px;
    font-size: .875rem;
    line-height: 1.5;
    white-space: pre-wrap;
    word-break: break-word;
}
.msg-user .comm-msg-bubble {
    background: #eff6ff;
    border: 1px solid #bfdbfe;
    border-bottom-left-radius: 4px;
}
.msg-admin .comm-msg-bubble {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    border-bottom-right-radius: 4px;
}

.comm-msg-info {
    display: flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 3px;
    font-size: .72rem;
    color: #9ca3af;
}
.comm-msg-info .comm-msg-name { font-weight: 600; color: #6b7280; }
.comm-msg-info .comm-admin-badge {
    background: var(--comm-primary);
    color: #fff;
    font-size: .55rem;
    padding: 1px 5px;
    border-radius: 6px;
    font-weight: 600;
}
.msg-admin .comm-msg-info { justify-content: flex-end; }

.comm-msg-read-status {
    font-size: .65rem;
    color: #22c55e;
    margin-top: 2px;
}
.msg-admin .comm-msg-read-status { text-align: right; }

/* Reply composer */
.comm-reply-box {
    padding: 14px 20px;
    background: #fff;
    border-top: 1px solid #e5e7eb;
    display: flex;
    gap: 10px;
    align-items: flex-end;
}
.comm-reply-input {
    flex: 1;
    padding: 10px 14px;
    border: 1.5px solid #e5e7eb;
    border-radius: var(--comm-radius);
    font-size: .875rem;
    font-family: inherit;
    resize: none;
    min-height: 42px;
    max-height: 120px;
    transition: border-color .2s, box-shadow .2s;
}
.comm-reply-input:focus {
    outline: none;
    border-color: var(--comm-primary);
    box-shadow: 0 0 0 3px rgba(79,70,229,.1);
}
.comm-reply-btn {
    padding: 10px 20px;
    background: var(--comm-primary);
    color: #fff;
    border: none;
    border-radius: var(--comm-radius);
    font-weight: 600;
    font-size: .85rem;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 6px;
    transition: background .2s;
    white-space: nowrap;
}
.comm-reply-btn:hover { background: #4338ca; }
.comm-reply-btn:disabled { opacity: .6; cursor: not-allowed; }

/* No thread selected */
.comm-no-thread {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #9ca3af;
    text-align: center;
}
.comm-no-thread i { font-size: 3rem; margin-bottom: 12px; }
.comm-no-thread h5 { margin: 0 0 6px 0; color: #6b7280; }
.comm-no-thread p { margin: 0; font-size: .875rem; }

/* Mobile */
@media (max-width: 768px) {
    .comm-wrapper { flex-direction: column; }
    .comm-threads-panel { width: 100%; max-height: 50vh; }
    .comm-message { max-width: 90%; }
}
</style>

<div class="comm-wrapper">
    
    <div class="comm-threads-panel">
        <div class="comm-threads-header">
            <h4><i class="bi bi-chat-left-text-fill"></i> Communicator</h4>
            <div class="comm-filter-tabs">
                <button class="comm-filter-tab active" data-filter="all">All</button>
                <button class="comm-filter-tab" data-filter="open">Open</button>
                <button class="comm-filter-tab" data-filter="replied">Replied</button>
                <button class="comm-filter-tab" data-filter="closed">Closed</button>
            </div>
        </div>
        <div class="comm-threads-list" id="comm-threads-list">
            <div class="comm-threads-loading">
                <div class="spinner-border spinner-border-sm text-primary" role="status"></div>
            </div>
        </div>
    </div>

    
    <div class="comm-messages-panel" id="comm-messages-panel">
        <div class="comm-no-thread" id="comm-no-thread">
            <i class="bi bi-chat-square-text"></i>
            <h5>Select a conversation</h5>
            <p>Choose a thread from the left to view messages and reply.</p>
        </div>

        <div id="comm-msg-view" style="display:none; flex:1; display:flex; flex-direction:column;">
            <div class="comm-msg-header" id="comm-msg-header">
                <div class="comm-msg-header-info">
                    <h5 id="comm-msg-subject"></h5>
                    <div class="comm-msg-sender-info" id="comm-msg-sender-info"></div>
                </div>
                <div class="comm-msg-actions">
                    <button class="comm-action-btn btn-close-thread" id="comm-close-thread-btn">
                        <i class="bi bi-x-circle"></i> Close Thread
                    </button>
                </div>
            </div>
            <div class="comm-msg-list" id="comm-msg-list"></div>
            <div class="comm-reply-box" id="comm-reply-box">
                <textarea class="comm-reply-input" id="comm-reply-input" placeholder="Type your reply..." rows="1"></textarea>
                <button class="comm-reply-btn" id="comm-reply-btn">
                    <i class="bi bi-send-fill"></i> Reply
                </button>
            </div>
        </div>
    </div>
</div>

<script>
(function() {
    'use strict';

    var threadsUrl = <?php echo json_encode(route('admin.communicator.threads'), 15, 512) ?>;
    var threadUrl  = <?php echo json_encode(route('admin.communicator.thread', ['threadId' => '__ID__']), 512) ?>;
    var replyUrl   = <?php echo json_encode(route('admin.communicator.reply', ['threadId' => '__ID__']), 512) ?>;
    var closeUrl   = <?php echo json_encode(route('admin.communicator.close', ['threadId' => '__ID__']), 512) ?>;
    var csrfToken  = document.querySelector('meta[name="csrf-token"]')
                        ? document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        : '';

    var currentFilter = 'all';
    var currentThreadId = null;

    // ── Load threads ────────────────────────────────────
    function loadThreads() {
        var listEl = document.getElementById('comm-threads-list');
        listEl.innerHTML = '<div class="comm-threads-loading"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>';

        fetch(threadsUrl + '?status=' + currentFilter, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(threads) {
            if (!threads.length) {
                listEl.innerHTML = '<div class="comm-threads-empty"><i class="bi bi-inbox"></i><div>No conversations found</div></div>';
                return;
            }

            var html = '';
            threads.forEach(function(t) {
                var activeClass = currentThreadId == t.thread_id ? ' active' : '';
                var unreadClass = t.unread > 0 ? ' has-unread' : '';

                html += '<div class="comm-thread-item' + activeClass + unreadClass + '" data-thread="' + t.thread_id + '">';
                html += '<div class="comm-thread-subject">' + escHtml(t.subject) + '</div>';
                html += '<div class="comm-thread-preview">' + escHtml(t.message) + '</div>';
                html += '<div class="comm-thread-meta">';
                html += '<span class="comm-sender">' + escHtml(t.sender) + ' (' + escHtml(t.business) + ')</span>';
                html += '<div class="comm-thread-badges">';
                html += '<span class="comm-badge comm-badge-' + t.status + '">' + t.status + '</span>';
                if (t.unread > 0) {
                    html += '<span class="comm-badge comm-badge-unread">' + t.unread + ' new</span>';
                }
                if (t.replies > 0) {
                    html += '<span style="font-size:.65rem;color:#9ca3af;">' + t.replies + ' replies</span>';
                }
                html += '</div></div></div>';
            });

            listEl.innerHTML = html;

            // Thread click handlers
            listEl.querySelectorAll('.comm-thread-item').forEach(function(el) {
                el.addEventListener('click', function() {
                    var tid = parseInt(this.getAttribute('data-thread'));
                    openThread(tid);
                    // Update active
                    listEl.querySelectorAll('.comm-thread-item').forEach(function(i) { i.classList.remove('active'); });
                    this.classList.add('active');
                    this.classList.remove('has-unread');
                });
            });
        });
    }

    // ── Open thread ─────────────────────────────────────
    function openThread(tid) {
        currentThreadId = tid;

        var noThread = document.getElementById('comm-no-thread');
        var msgView = document.getElementById('comm-msg-view');
        var msgList = document.getElementById('comm-msg-list');

        noThread.style.display = 'none';
        msgView.style.display = 'flex';
        msgList.innerHTML = '<div class="comm-threads-loading"><div class="spinner-border spinner-border-sm text-primary" role="status"></div></div>';

        var url = threadUrl.replace('__ID__', tid);
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            document.getElementById('comm-msg-subject').textContent = data.subject;
            document.getElementById('comm-msg-sender-info').textContent = 'Thread #' + tid + ' • Status: ' + data.status;

            var html = '';
            data.messages.forEach(function(msg) {
                var cls = msg.is_admin ? 'msg-admin' : 'msg-user';
                html += '<div class="comm-message ' + cls + '">';
                html += '<div class="comm-msg-info">';
                html += '<span class="comm-msg-name">' + escHtml(msg.sender) + '</span>';
                if (msg.is_admin) html += '<span class="comm-admin-badge">Admin</span>';
                html += '<span>' + msg.created_at + '</span>';
                html += '</div>';
                html += '<div class="comm-msg-bubble">' + escHtml(msg.message) + '</div>';
                if (msg.read_at) {
                    html += '<div class="comm-msg-read-status"><i class="bi bi-check2-all"></i> Read ' + msg.read_at + '</div>';
                }
                html += '</div>';
            });

            msgList.innerHTML = html;
            msgList.scrollTop = msgList.scrollHeight;

            // Show/hide close button
            var closeBtn = document.getElementById('comm-close-thread-btn');
            if (data.status === 'closed') {
                closeBtn.style.display = 'none';
                document.getElementById('comm-reply-box').style.display = 'none';
            } else {
                closeBtn.style.display = '';
                document.getElementById('comm-reply-box').style.display = '';
            }
        });
    }

    // ── Reply ───────────────────────────────────────────
    var replyBtn = document.getElementById('comm-reply-btn');
    var replyInput = document.getElementById('comm-reply-input');

    replyBtn.addEventListener('click', function() {
        var msg = replyInput.value.trim();
        if (!msg || !currentThreadId) return;

        replyBtn.disabled = true;
        replyBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Sending...';

        var url = replyUrl.replace('__ID__', currentThreadId);
        var formData = new FormData();
        formData.append('message', msg);

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            replyBtn.disabled = false;
            replyBtn.innerHTML = '<i class="bi bi-send-fill"></i> Reply';

            if (data.success) {
                replyInput.value = '';
                // Append the new message to the list
                var msgList = document.getElementById('comm-msg-list');
                var reply = data.reply;
                var html = '<div class="comm-message msg-admin">';
                html += '<div class="comm-msg-info">';
                html += '<span class="comm-msg-name">' + escHtml(reply.sender) + '</span>';
                html += '<span class="comm-admin-badge">Admin</span>';
                html += '<span>' + reply.created_at + '</span>';
                html += '</div>';
                html += '<div class="comm-msg-bubble">' + escHtml(reply.message) + '</div>';
                html += '</div>';
                msgList.insertAdjacentHTML('beforeend', html);
                msgList.scrollTop = msgList.scrollHeight;

                // Refresh thread list
                loadThreads();
            } else {
                alert(data.msg || 'Failed to send reply.');
            }
        })
        .catch(function() {
            replyBtn.disabled = false;
            replyBtn.innerHTML = '<i class="bi bi-send-fill"></i> Reply';
            alert('Network error. Please try again.');
        });
    });

    // Enter to send (Shift+Enter for newline)
    replyInput.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            replyBtn.click();
        }
    });

    // ── Close thread ────────────────────────────────────
    document.getElementById('comm-close-thread-btn').addEventListener('click', function() {
        if (!currentThreadId) return;
        if (!confirm('Close this thread? It cannot be reopened.')) return;

        var url = closeUrl.replace('__ID__', currentThreadId);
        var formData = new FormData();

        fetch(url, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            if (data.success) {
                openThread(currentThreadId);
                loadThreads();
            }
        });
    });

    // ── Filter tabs ─────────────────────────────────────
    document.querySelectorAll('.comm-filter-tab').forEach(function(tab) {
        tab.addEventListener('click', function() {
            document.querySelectorAll('.comm-filter-tab').forEach(function(t) { t.classList.remove('active'); });
            this.classList.add('active');
            currentFilter = this.getAttribute('data-filter');
            loadThreads();
        });
    });

    function escHtml(str) {
        var div = document.createElement('div');
        div.appendChild(document.createTextNode(str || ''));
        return div.innerHTML;
    }

    // Auto-refresh threads every 30s
    setInterval(function() {
        loadThreads();
        if (currentThreadId) openThread(currentThreadId);
    }, 30000);

    // Initial load
    loadThreads();

})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>