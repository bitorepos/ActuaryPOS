

<?php $__env->startSection('title', 'Documentation CMS'); ?>

<?php $__env->startSection('content'); ?>
<style>
.cms-wrapper {
    padding: 20px;
    max-width: 1400px;
    margin: 0 auto;
}
.cms-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    flex-wrap: wrap;
    gap: 10px;
}
.cms-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
}
.cms-header h2 i { color: #6366f1; }
.cms-actions { display: flex; gap: 8px; flex-wrap: wrap; }
.cms-btn {
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
.cms-btn-primary { background: #6366f1; color: #fff; }
.cms-btn-primary:hover { background: #4f46e5; color: #fff; }
.cms-btn-secondary { background: #e2e8f0; color: #475569; }
.cms-btn-secondary:hover { background: #cbd5e1; color: #334155; }
.cms-btn-success { background: #d1fae5; color: #065f46; }
.cms-btn-success:hover { background: #a7f3d0; color: #064e3b; }
.cms-btn-success { background: #10b981; color: #fff; }
.cms-btn-success:hover { background: #059669; color: #fff; }
.cms-btn-danger { background: #ef4444; color: #fff; }
.cms-btn-danger:hover { background: #dc2626; color: #fff; }
.cms-btn-sm { padding: 4px 10px; font-size: 0.8rem; }

/* Filters bar */
.cms-filters {
    display: flex;
    gap: 10px;
    margin-bottom: 16px;
    flex-wrap: wrap;
    align-items: center;
}
.cms-filters select, .cms-filters input {
    padding: 6px 12px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    font-size: 0.875rem;
    background: #fff;
}
.cms-filters select:focus, .cms-filters input:focus {
    outline: none;
    border-color: #6366f1;
    box-shadow: 0 0 0 2px rgba(99,102,241,.15);
}

/* Table */
.cms-table-wrap {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 1px 3px rgba(0,0,0,.08);
    overflow: hidden;
}
.cms-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.875rem;
}
.cms-table thead th {
    background: #f8fafc;
    padding: 10px 14px;
    text-align: left;
    font-weight: 600;
    color: #475569;
    border-bottom: 2px solid #e2e8f0;
    white-space: nowrap;
}
.cms-table tbody td {
    padding: 10px 14px;
    border-bottom: 1px solid #f1f5f9;
    vertical-align: middle;
}
.cms-table tbody tr:hover { background: #f8fafc; }
.cms-table tbody tr.inactive { opacity: 0.5; }

.cms-slug { font-family: monospace; font-size: 0.8rem; color: #6366f1; }
.cms-lang-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
    background: #ede9fe;
    color: #6d28d9;
}
.cms-tab-badge {
    display: inline-block;
    padding: 2px 8px;
    border-radius: 10px;
    font-size: 0.75rem;
    background: #e0f2fe;
    color: #0369a1;
}
.cms-version {
    font-family: monospace;
    font-size: 0.8rem;
    color: #059669;
    font-weight: 600;
}
.cms-status-active {
    color: #059669;
    font-weight: 600;
}
.cms-status-inactive {
    color: #ef4444;
    font-weight: 600;
}
.cms-meta {
    font-size: 0.75rem;
    color: #94a3b8;
}
.cms-empty {
    text-align: center;
    padding: 40px;
    color: #94a3b8;
}
.cms-empty i { font-size: 2rem; display: block; margin-bottom: 10px; }

/* Stats bar */
.cms-stats {
    display: flex;
    gap: 20px;
    margin-bottom: 16px;
    flex-wrap: wrap;
}
.cms-stat {
    background: #fff;
    border-radius: 8px;
    padding: 12px 20px;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
    display: flex;
    align-items: center;
    gap: 10px;
}
.cms-stat i { font-size: 1.2rem; color: #6366f1; }
.cms-stat-val { font-size: 1.3rem; font-weight: 700; color: #1e293b; }
.cms-stat-label { font-size: 0.75rem; color: #94a3b8; }

/* Alert */
.cms-alert {
    padding: 10px 16px;
    border-radius: 6px;
    margin-bottom: 16px;
    font-size: 0.875rem;
}
.cms-alert-success { background: #d1fae5; color: #065f46; }
.cms-alert-error { background: #fee2e2; color: #991b1b; }
</style>

<div class="cms-wrapper">
    <div class="cms-header">
        <h2><i class="bi bi-file-earmark-richtext"></i> Documentation CMS</h2>
        <div class="cms-actions">
            <a href="<?php echo e(route('docs.cms.create'), false); ?>" class="cms-btn cms-btn-primary">
                <i class="bi bi-plus-lg"></i> New Page
            </a>
            <form action="<?php echo e(route('docs.cms.seed'), false); ?>" method="POST" style="display:inline;"
                  onsubmit="return confirm('Import markdown files from cp-docs/ into the database?\nExisting pages will NOT be overwritten.')">
                <?php echo csrf_field(); ?>
                <button type="submit" class="cms-btn cms-btn-secondary">
                    <i class="bi bi-download"></i> Import from Files
                </button>
            </form>
            <a href="<?php echo e(route('documentation.index'), false); ?>" class="cms-btn cms-btn-secondary">
                <i class="bi bi-eye"></i> View Docs
            </a>
            <a href="<?php echo e(route('docs.public'), false); ?>" class="cms-btn cms-btn-success" target="_blank" rel="noopener noreferrer">
                <i class="bi bi-globe"></i> Public Docs
            </a>

        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="cms-alert cms-alert-success">
            <i class="bi bi-check-circle"></i> <?php echo e(session('success'), false); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="cms-alert cms-alert-error">
            <i class="bi bi-exclamation-triangle"></i> <?php echo e(session('error'), false); ?>

        </div>
    <?php endif; ?>

    
    <div class="cms-stats">
        <div class="cms-stat">
            <i class="bi bi-file-earmark-text"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->count(), false); ?></div>
                <div class="cms-stat-label">Total Pages</div>
            </div>
        </div>
        <div class="cms-stat">
            <i class="bi bi-globe"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->where('visibility', 'public')->count(), false); ?></div>
                <div class="cms-stat-label">Public</div>
            </div>
        </div>
        <div class="cms-stat">
            <i class="bi bi-lock"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->where('visibility', 'private')->count(), false); ?></div>
                <div class="cms-stat-label">Private</div>
            </div>
        </div>
        <div class="cms-stat">
            <i class="bi bi-shield-lock"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->where('visibility', 'superadmin')->count(), false); ?></div>
                <div class="cms-stat-label">Superadmin</div>
            </div>
        </div>
        <div class="cms-stat">
            <i class="bi bi-translate"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->pluck('language')->unique()->count(), false); ?></div>
                <div class="cms-stat-label">Languages</div>
            </div>
        </div>
        <div class="cms-stat">
            <i class="bi bi-layers"></i>
            <div>
                <div class="cms-stat-val"><?php echo e($pages->pluck('tab_type')->unique()->filter()->count(), false); ?></div>
                <div class="cms-stat-label">Tabs</div>
            </div>
        </div>
    </div>

    
    <form class="cms-filters" method="GET" action="<?php echo e(route('docs.cms.index'), false); ?>">
        <select name="language" onchange="this.form.submit()">
            <option value="">All Languages</option>
            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($l, false); ?>" <?php if($language === $l): ?> selected <?php endif; ?>><?php echo e(strtoupper($l), false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="tab_type" onchange="this.form.submit()">
            <option value="">All Tabs</option>
            <?php $__currentLoopData = $tabTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($t, false); ?>" <?php if($tab_type === $t): ?> selected <?php endif; ?>><?php echo e($t, false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <select name="visibility" onchange="this.form.submit()">
            <option value="">All Visibility</option>
            <?php $__currentLoopData = $visibilities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($v, false); ?>" <?php if($visibility === $v): ?> selected <?php endif; ?>><?php echo e(ucfirst($v), false); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <input type="text" name="q" value="<?php echo e($search, false); ?>" placeholder="Search pages..." style="min-width:200px;">
        <button type="submit" class="cms-btn cms-btn-secondary cms-btn-sm">
            <i class="bi bi-search"></i> Search
        </button>
        <?php if($language || $tab_type || $visibility || $search): ?>
            <a href="<?php echo e(route('docs.cms.index'), false); ?>" class="cms-btn cms-btn-secondary cms-btn-sm">
                <i class="bi bi-x-lg"></i> Clear
            </a>
        <?php endif; ?>
    </form>

    
    <div class="cms-table-wrap">
        <?php if($pages->isEmpty()): ?>
            <div class="cms-empty">
                <i class="bi bi-inbox"></i>
                No documentation pages found.<br>
                Click <strong>"Import from Files"</strong> to seed from existing markdown files,<br>
                or <strong>"New Page"</strong> to create one manually.
            </div>
        <?php else: ?>
        <table class="cms-table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Slug</th>
                    <th>Lang</th>
                    <th>Tab</th>
                    <th>Module</th>
                    <th>Version</th>
                    <th>Visibility</th>
                    <th>Updated</th>
                    <th style="text-align:right;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $pages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="<?php echo e($page->visibility === 'superadmin' ? 'inactive' : '', false); ?>">
                    <td>
                        <?php if($page->icon): ?>
                            <i class="<?php echo e($page->icon, false); ?>" style="color:#6366f1;margin-right:4px;"></i>
                        <?php endif; ?>
                        <strong><?php echo e(Str::limit($page->title, 40), false); ?></strong>
                    </td>
                    <td><span class="cms-slug"><?php echo e($page->slug, false); ?></span></td>
                    <td><span class="cms-lang-badge"><?php echo e(strtoupper($page->language), false); ?></span></td>
                    <td>
                        <?php if($page->tab_type): ?>
                            <span class="cms-tab-badge"><?php echo e($page->tab_type, false); ?></span>
                        <?php else: ?>
                            <span class="cms-meta">—</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($page->module_name): ?>
                            <span class="cms-tab-badge" style="background:#fef3c7;color:#92400e;"><?php echo e($page->module_name, false); ?></span>
                        <?php else: ?>
                            <span class="cms-meta">—</span>
                        <?php endif; ?>
                    </td>
                    <td><span class="cms-version">v<?php echo e($page->version, false); ?></span></td>
                    <td>
                        <?php if($page->visibility === 'public'): ?>
                            <span class="cms-status-active"><i class="bi bi-globe" style="font-size:.7rem"></i> Public</span>
                        <?php elseif($page->visibility === 'private'): ?>
                            <span style="color:#6366f1;font-weight:600;"><i class="bi bi-lock" style="font-size:.7rem"></i> Private</span>
                        <?php else: ?>
                            <span class="cms-status-inactive"><i class="bi bi-shield-lock" style="font-size:.7rem"></i> Superadmin</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <span class="cms-meta">
                            <?php echo e($page->updated_at ? $page->updated_at->diffForHumans() : '—', false); ?>

                        </span>
                    </td>
                    <td style="text-align:right; white-space:nowrap;">
                        <a href="<?php echo e(route('docs.cms.edit', $page->id), false); ?>" class="cms-btn cms-btn-primary cms-btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="<?php echo e(route('docs.cms.toggle', $page->id), false); ?>" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <button type="submit" class="cms-btn cms-btn-secondary cms-btn-sm"
                                    title="Cycle visibility: <?php echo e($page->visibility, false); ?>">
                                <i class="bi bi-arrow-repeat"></i>
                            </button>
                        </form>
                        <form action="<?php echo e(route('docs.cms.destroy', $page->id), false); ?>" method="POST" style="display:inline;"
                              onsubmit="return confirm('Permanently delete \'<?php echo e(addslashes($page->title), false); ?>\'?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="cms-btn cms-btn-danger cms-btn-sm" title="Delete">
                                <i class="bi bi-trash3"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>