

<?php $__env->startSection('title', $page ? 'Edit: ' . $page->title : 'New Documentation Page'); ?>

<?php $__env->startSection('content'); ?>
<style>
.editor-wrapper {
    padding: 20px;
    max-width: 1600px;
    margin: 0 auto;
}
.editor-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 16px;
    flex-wrap: wrap;
    gap: 10px;
}
.editor-header h2 {
    margin: 0;
    font-size: 1.4rem;
    font-weight: 700;
    color: #1e293b;
}
.editor-header h2 i { color: #6366f1; }

.editor-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 6px;
    font-size: 0.875rem;
    font-weight: 500;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.15s;
}
.editor-btn-primary { background: #6366f1; color: #fff; }
.editor-btn-primary:hover { background: #4f46e5; color: #fff; }
.editor-btn-secondary { background: #e2e8f0; color: #475569; }
.editor-btn-secondary:hover { background: #cbd5e1; color: #334155; }
.editor-btn-success { background: #10b981; color: #fff; }
.editor-btn-success:hover { background: #059669; color: #fff; }

/* Version info */
.editor-version-info {
    display: flex;
    gap: 16px;
    margin-bottom: 12px;
    font-size: 0.8rem;
    color: #64748b;
    flex-wrap: wrap;
}
.editor-version-info span { display: flex; align-items: center; gap: 4px; }
.editor-version-info i { color: #6366f1; }

/* Alert */
.editor-alert {
    padding: 10px 16px;
    border-radius: 6px;
    margin-bottom: 16px;
    font-size: 0.875rem;
}
.editor-alert-success { background: #d1fae5; color: #065f46; }
.editor-alert-error { background: #fee2e2; color: #991b1b; }

/* Form layout */
.editor-form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.editor-left, .editor-right {
    display: flex;
    flex-direction: column;
    gap: 0;
}

/* Field group */
.editor-fields {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    padding: 16px;
    margin-bottom: 16px;
}
.editor-fields h4 {
    margin: 0 0 12px 0;
    font-size: 0.9rem;
    font-weight: 600;
    color: #475569;
    display: flex;
    align-items: center;
    gap: 6px;
}
.editor-fields h4 i { color: #6366f1; font-size: 0.85rem; }

.editor-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-bottom: 12px;
}
.editor-row-full {
    margin-bottom: 12px;
}
.editor-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #475569;
    margin-bottom: 4px;
}
.editor-input, .editor-select {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.875rem;
    background: #fff;
    box-sizing: border-box;
}
.editor-input:focus, .editor-select:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,.15);
}

/* Content textarea */
.editor-content-area {
    width: 100%;
    min-height: 500px;
    padding: 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-family: 'Fira Code', 'Consolas', 'Monaco', monospace;
    font-size: 0.85rem;
    line-height: 1.6;
    resize: vertical;
    box-sizing: border-box;
    tab-size: 4;
}
.editor-content-area:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,.15);
}

/* Preview panel */
.editor-preview-panel {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.editor-preview-header {
    padding: 10px 16px;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
    font-size: 0.85rem;
    font-weight: 600;
    color: #475569;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.editor-preview-body {
    padding: 20px;
    overflow-y: auto;
    max-height: 700px;
    flex: 1;
    font-size: 0.9rem;
    line-height: 1.7;
}
.editor-preview-body h1 { font-size: 1.6rem; margin-top: 0; }
.editor-preview-body h2 { font-size: 1.3rem; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; }
.editor-preview-body h3 { font-size: 1.1rem; }
.editor-preview-body pre {
    background: #1e293b;
    color: #e2e8f0;
    padding: 14px;
    border-radius: 6px;
    overflow-x: auto;
    font-size: 0.82rem;
}
.editor-preview-body code {
    background: #f1f5f9;
    padding: 2px 6px;
    border-radius: 3px;
    font-size: 0.85em;
}
.editor-preview-body pre code {
    background: transparent;
    padding: 0;
}
.editor-preview-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 12px 0;
}
.editor-preview-body th, .editor-preview-body td {
    border: 1px solid #e2e8f0;
    padding: 8px 12px;
    text-align: left;
}
.editor-preview-body th { background: #f8fafc; font-weight: 600; }
.editor-preview-body blockquote {
    border-left: 3px solid #6366f1;
    padding-left: 14px;
    color: #64748b;
    margin: 12px 0;
}
.editor-preview-body img { max-width: 100%; border-radius: 6px; }

/* Checkbox */
.editor-check {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-top: 8px;
}
.editor-check input[type="checkbox"] {
    width: 18px;
    height: 18px;
    accent-color: #6366f1;
}

/* Placeholder hint */
.editor-hint {
    padding: 10px 14px;
    background: #fffbeb;
    border: 1px solid #fef3c7;
    border-radius: 6px;
    font-size: 0.78rem;
    color: #92400e;
    margin-top: 8px;
}
.editor-hint code {
    background: #fef3c7;
    padding: 1px 4px;
    border-radius: 2px;
    font-size: 0.85em;
}

/* Responsive */
@media (max-width: 1100px) {
    .editor-form { grid-template-columns: 1fr; }
}
</style>

<div class="editor-wrapper">
    <div class="editor-header">
        <h2>
            <i class="bi bi-<?php echo e($page ? 'pencil-square' : 'plus-circle', false); ?>"></i>
            <?php echo e($page ? 'Edit Page' : 'New Page', false); ?>

            <?php if($page): ?>
                <small style="font-weight:400; color:#94a3b8; font-size:0.8rem;">
                    — <?php echo e($page->slug, false); ?> (<?php echo e(strtoupper($page->language), false); ?>)
                </small>
            <?php endif; ?>
        </h2>
        <div style="display:flex; gap:8px;">
            <a href="<?php echo e(route('docs.cms.index'), false); ?>" class="editor-btn editor-btn-secondary">
                <i class="bi bi-arrow-left"></i> Back to CMS
            </a>
            <?php if($page): ?>
                <a href="<?php echo e(route('documentation.index', $page->slug), false); ?>" class="editor-btn editor-btn-secondary" target="_blank">
                    <i class="bi bi-eye"></i> View Live
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="editor-alert editor-alert-success">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success'), false); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="editor-alert editor-alert-error">
            <i class="bi bi-exclamation-triangle"></i> <?php echo e(session('error'), false); ?>

        </div>
    <?php endif; ?>
    <?php if($errors->any()): ?>
        <div class="editor-alert editor-alert-error">
            <i class="bi bi-exclamation-triangle"></i>
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <?php echo e($error, false); ?><br> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if($page): ?>
    <div class="editor-version-info">
        <span><i class="bi bi-tag"></i> Version <?php echo e($page->version, false); ?></span>
        <span><i class="bi bi-clock"></i> Updated <?php echo e($page->updated_at ? $page->updated_at->diffForHumans() : 'N/A', false); ?></span>
        <span><i class="bi bi-person"></i> By <?php echo e($page->updater->username ?? $page->updater->first_name ?? 'System', false); ?></span>
        <span><i class="bi bi-eye"></i> Visibility: <?php echo e(ucfirst($page->visibility), false); ?></span>
        <?php if($page->module_name): ?>
            <span><i class="bi bi-puzzle"></i> Module: <?php echo e($page->module_name, false); ?></span>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <form method="POST"
          action="<?php echo e($page ? route('docs.cms.update', $page->id) : route('docs.cms.store'), false); ?>">
        <?php echo csrf_field(); ?>
        <?php if($page): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

        <div class="editor-form">
            
            <div class="editor-left">

                <div class="editor-fields">
                    <h4><i class="bi bi-info-circle"></i> Page Details</h4>

                    <div class="editor-row">
                        <div>
                            <label class="editor-label">Slug *</label>
                            <input type="text" name="slug" class="editor-input"
                                   value="<?php echo e(old('slug', $page->slug ?? ''), false); ?>"
                                   placeholder="e.g. multi-currency"
                                   <?php echo e($page ? 'readonly' : 'required', false); ?>

                                   style="<?php echo e($page ? 'background:#f1f5f9;' : '', false); ?>">
                        </div>
                        <div>
                            <label class="editor-label">Language *</label>
                            <select name="language" class="editor-select" <?php echo e($page ? 'disabled' : 'required', false); ?>>
                                <option value="en" <?php echo e((old('language', $page->language ?? 'en')) === 'en' ? 'selected' : '', false); ?>>English (EN)</option>
                                <option value="ur" <?php echo e((old('language', $page->language ?? '')) === 'ur' ? 'selected' : '', false); ?>>Urdu (UR)</option>
                                <option value="ar" <?php echo e((old('language', $page->language ?? '')) === 'ar' ? 'selected' : '', false); ?>>Arabic (AR)</option>
                            </select>
                            <?php if($page): ?>
                                <input type="hidden" name="language" value="<?php echo e($page->language, false); ?>">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="editor-row">
                        <div>
                            <label class="editor-label">Title *</label>
                            <input type="text" name="title" class="editor-input"
                                   value="<?php echo e(old('title', $page->title ?? ''), false); ?>"
                                   placeholder="Page title" required>
                        </div>
                        <div>
                            <label class="editor-label">Tab Type</label>
                            <input type="text" name="tab_type" class="editor-input"
                                   value="<?php echo e(old('tab_type', $page->tab_type ?? ''), false); ?>"
                                   placeholder="e.g. base-software"
                                   list="tab-list">
                            <datalist id="tab-list">
                                <?php $__currentLoopData = $tabTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($t, false); ?>">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <option value="quick-startup">
                                <option value="base-software">
                                <option value="modules">
                                <option value="superadmin">
                                <option value="version-log">
                                <option value="contact-admin">
                            </datalist>
                        </div>
                    </div>

                    <div class="editor-row">
                        <div>
                            <label class="editor-label">Module Name</label>
                            <input type="text" name="module_name" class="editor-input"
                                   value="<?php echo e(old('module_name', $page->module_name ?? ''), false); ?>"
                                   placeholder="e.g. Foodpanda (leave blank if not module-specific)">
                        </div>
                        <div>
                            <label class="editor-label">Visibility *</label>
                            <select name="visibility" class="editor-select" required>
                                <option value="public" <?php echo e((old('visibility', $page->visibility ?? 'private')) === 'public' ? 'selected' : '', false); ?>>Public — visible to all</option>
                                <option value="private" <?php echo e((old('visibility', $page->visibility ?? 'private')) === 'private' ? 'selected' : '', false); ?>>Private — logged-in users</option>
                                <option value="superadmin" <?php echo e((old('visibility', $page->visibility ?? '')) === 'superadmin' ? 'selected' : '', false); ?>>Superadmin — admins only</option>
                            </select>
                        </div>
                    </div>

                    <div class="editor-row">
                        <div>
                            <label class="editor-label">Sort Order</label>
                            <input type="number" name="sort_order" class="editor-input"
                                   value="<?php echo e(old('sort_order', $page->sort_order ?? 0), false); ?>"
                                   min="0" placeholder="0">
                        </div>
                        <div>
                            <label class="editor-label">Icon (Bootstrap Icons class)</label>
                            <input type="text" name="icon" class="editor-input"
                                   value="<?php echo e(old('icon', $page->icon ?? ''), false); ?>"
                                   placeholder="e.g. bi-lightning-charge">
                        </div>
                    </div>
                </div>

                <div class="editor-fields" style="flex:1;">
                    <h4><i class="bi bi-markdown"></i> Content</h4>
                    <textarea name="content" id="cms-content" class="editor-content-area"
                              placeholder="Write your documentation content in Markdown..." required><?php echo e(old('content', $page->content ?? ''), false); ?></textarea>
                    <div class="editor-hint">
                        <strong>Dynamic Placeholders:</strong>
                        <code>{application_name}</code> → App Name &nbsp;|&nbsp;
                        <code>{app_version}</code> → Version &nbsp;|&nbsp;
                        <code>{app_title}</code> → App Title &nbsp;|&nbsp;
                        <code>{business_name}</code> → Business Name
                    </div>
                </div>

                <div style="display:flex; gap:10px; margin-top:12px;">
                    <button type="submit" class="editor-btn editor-btn-success">
                        <i class="bi bi-check-lg"></i> <?php echo e($page ? 'Save Changes (v' . ($page->version + 1) . ')' : 'Create Page', false); ?>

                    </button>
                    <a href="<?php echo e(route('docs.cms.index'), false); ?>" class="editor-btn editor-btn-secondary">
                        Cancel
                    </a>
                </div>
            </div>

            
            <div class="editor-right">
                <div class="editor-preview-panel" style="flex:1;">
                    <div class="editor-preview-header">
                        <span><i class="bi bi-eye"></i> Live Preview</span>
                        <span id="preview-status" style="font-size:0.75rem; color:#94a3b8;">Rendered</span>
                    </div>
                    <div class="editor-preview-body" id="cms-preview">
                        <p style="color:#94a3b8; text-align:center; margin-top:40px;">
                            <i class="bi bi-markdown" style="font-size:2rem; display:block; margin-bottom:10px;"></i>
                            Start typing to see live preview...
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>
<script>
(function() {
    const textarea = document.getElementById('cms-content');
    const preview = document.getElementById('cms-preview');
    const status = document.getElementById('preview-status');
    let debounce = null;

    function renderPreview() {
        const raw = textarea.value;
        if (!raw.trim()) {
            preview.innerHTML = '<p style="color:#94a3b8;text-align:center;margin-top:40px;">' +
                '<i class="bi bi-markdown" style="font-size:2rem;display:block;margin-bottom:10px;"></i>' +
                'Start typing to see live preview...</p>';
            status.textContent = 'Empty';
            return;
        }

        status.textContent = 'Rendering...';
        try {
            // Check for RAWHTML marker
            if (raw.trimStart().startsWith('<!--RAWHTML-->')) {
                preview.innerHTML = raw.replace('<!--RAWHTML-->', '').trim();
            } else {
                preview.innerHTML = marked.parse(raw);
            }
            status.textContent = 'Rendered (' + raw.length + ' chars)';
        } catch (e) {
            preview.innerHTML = '<pre style="color:red;">' + e.message + '</pre>';
            status.textContent = 'Error';
        }
    }

    textarea.addEventListener('input', function() {
        clearTimeout(debounce);
        debounce = setTimeout(renderPreview, 300);
    });

    // Tab key inserts tab instead of moving focus
    textarea.addEventListener('keydown', function(e) {
        if (e.key === 'Tab') {
            e.preventDefault();
            const start = this.selectionStart;
            const end = this.selectionEnd;
            this.value = this.value.substring(0, start) + '    ' + this.value.substring(end);
            this.selectionStart = this.selectionEnd = start + 4;
            renderPreview();
        }
    });

    // Initial render
    if (textarea.value.trim()) {
        renderPreview();
    }
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>