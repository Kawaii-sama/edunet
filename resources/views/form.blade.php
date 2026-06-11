@extends('layouts.admin')

@section('content')

{{-- Toast Notification --}}
<div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 9999;">
    <div id="appToast" class="toast align-items-center text-white border-0" role="alert">
        <div class="d-flex">
            <div class="toast-body fw-semibold" id="toastMessage">Action completed.</div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
        </div>
    </div>
</div>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card-body">

            {{-- Header --}}
            <div class="fb-header d-flex align-items-center justify-content-between mb-4">
                <div>
                    <h4 class="fb-title mb-0">
                        <i class="bi bi-ui-checks-grid me-2 text-primary"></i>Form Builder
                    </h4>
                    <p class="text-muted mb-0 small">Create dynamic forms visually</p>
                </div>
                <div class="d-flex align-items-center gap-2">
                    <span class="badge bg-primary-soft text-primary fs-6 px-3 py-2 rounded-pill">
                        <i class="bi bi-layers me-1"></i>
                        Fields Added: <strong id="fieldCount">0</strong>
                    </span>
                    <button class="btn btn-outline-primary btn-sm px-3" id="previewBtn">
                        <i class="bi bi-eye me-1"></i>Preview
                    </button>
                </div>
            </div>

            {{-- Form Title --}}
            <div class="mb-3" style="max-width: 600px;">
                <input type="text" id="formTitle" maxlength="200"
                       class="form-control form-control-lg fw-semibold"
                       placeholder="Untitled Form"
                       style="border: 2px solid #e2e8f0; border-radius: 10px;">
                <div class="d-flex justify-content-between mt-1">
                    <div class="text-muted small">
                        <i class="bi bi-link-45deg"></i>
                        Submission URL: <a href="#" class="text-primary text-decoration-none">{{ $title }}</a>
                    </div>
                    <small class="text-muted"><span id="titleCount">0</span>/200</small>
                </div>
            </div>

            {{-- Tabs --}}
            <ul class="nav nav-tabs mb-4">
                <li class="nav-item">
                    <a class="nav-link active fw-semibold" href="#">
                        <i class="bi bi-pencil-square me-1"></i>Form Editor
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-muted" href="#">
                        <i class="bi bi-gear me-1"></i>Settings
                    </a>
                </li>
            </ul>

            {{-- Main Row --}}
            <div class="row g-4">

                {{-- Canvas --}}
                <div class="col-lg-8">
                    <div id="dropCanvas" class="fb-canvas rounded-3 p-4">
                        <div id="emptyState" class="fb-empty text-center py-5">
                            <div class="fb-empty-icon mb-3">
                                <i class="bi bi-layout-text-window-reverse"></i>
                            </div>
                            <h6 class="fw-semibold text-secondary mb-1">Your canvas is empty</h6>
                            <p class="text-muted small mb-3">Drag fields from the right panel to start building</p>
                            <div class="fb-supports d-flex justify-content-center gap-3 flex-wrap">
                                <span class="badge bg-light text-secondary border"><i class="bi bi-input-cursor-text me-1"></i>Text</span>
                                <span class="badge bg-light text-secondary border"><i class="bi bi-menu-button-wide me-1"></i>Dropdown</span>
                                <span class="badge bg-light text-secondary border"><i class="bi bi-ui-radios me-1"></i>Radio</span>
                                <span class="badge bg-light text-secondary border"><i class="bi bi-file-earmark-arrow-up me-1"></i>File</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Panel --}}
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm rounded-3">
                        <div class="card-body p-3">

                            {{-- Panel Tabs --}}
                            <ul class="nav nav-pills mb-3">
                                <li class="nav-item flex-fill">
                                    <button id="addFieldsTab" class="nav-link active w-100" type="button">
                                        <i class="bi bi-plus-circle me-1"></i>Add Fields
                                    </button>
                                </li>
                                <li class="nav-item flex-fill">
                                    <button id="fieldOptionsTab" class="nav-link w-100" type="button">
                                        <i class="bi bi-sliders me-1"></i>Field Options
                                    </button>
                                </li>
                            </ul>

                            {{-- Add Fields Panel --}}
                            <div id="addFieldsPanel" class="row g-2">
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="text"><i class="bi bi-input-cursor-text d-block fs-5 mb-1"></i>Text Input</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="textarea"><i class="bi bi-textarea-resize d-block fs-5 mb-1"></i>Text Area</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="number"><i class="bi bi-123 d-block fs-5 mb-1"></i>Number</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="email"><i class="bi bi-envelope d-block fs-5 mb-1"></i>Email</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="phone"><i class="bi bi-telephone d-block fs-5 mb-1"></i>Phone</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="dropdown"><i class="bi bi-menu-button-wide d-block fs-5 mb-1"></i>Dropdown</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="radio"><i class="bi bi-ui-radios d-block fs-5 mb-1"></i>Radio</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="checkbox"><i class="bi bi-ui-checks d-block fs-5 mb-1"></i>Checkboxes</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="date"><i class="bi bi-calendar3 d-block fs-5 mb-1"></i>Date Picker</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="file"><i class="bi bi-file-earmark-arrow-up d-block fs-5 mb-1"></i>File Upload</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="title"><i class="bi bi-type-h1 d-block fs-5 mb-1"></i>Title</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="description"><i class="bi bi-text-paragraph d-block fs-5 mb-1"></i>Description</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="newline"><i class="bi bi-arrow-return-left d-block fs-5 mb-1"></i>New Line</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="pagebreak"><i class="bi bi-scissors d-block fs-5 mb-1"></i>Page Break</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="hidden"><i class="bi bi-eye-slash d-block fs-5 mb-1"></i>Hidden</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="state"><i class="bi bi-map d-block fs-5 mb-1"></i>State</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="city"><i class="bi bi-building d-block fs-5 mb-1"></i>City</div></div>
                                <div class="col-6"><div class="field-tile" draggable="true" data-type="statecity"><i class="bi bi-geo-alt d-block fs-5 mb-1"></i>State & City</div></div>
                            </div>

                            {{-- Field Options Panel --}}
                            <div id="fieldOptionsPanel" class="d-none">
                                <h6 class="fw-semibold mb-3">
                                    <i class="bi bi-sliders me-1 text-primary"></i>Field Options
                                </h6>

                                <label class="form-label small fw-semibold text-secondary">Label</label>
                                <input type="text" id="optionLabel" class="form-control form-control-sm mb-3">

                                <label class="form-label small fw-semibold text-secondary">Placeholder</label>
                                <input type="text" id="optionPlaceholder" class="form-control form-control-sm mb-3">

                                <label class="form-label small fw-semibold text-secondary">CSS Class</label>
                                <input type="text" id="optionClass" class="form-control form-control-sm mb-3">

                                <div class="form-check mb-3">
                                    <input type="checkbox" id="optionRequired" class="form-check-input">
                                    <label class="form-check-label small fw-semibold" for="optionRequired">Required Field</label>
                                </div>

                                <div id="textConfigWrapper">
                                    <label class="form-label small fw-semibold text-secondary">Min Characters</label>
                                    <input type="number" id="optionMin" class="form-control form-control-sm mb-3">

                                    <label class="form-label small fw-semibold text-secondary">Max Characters</label>
                                    <input type="number" id="optionMax" class="form-control form-control-sm mb-3">

                                    <label class="form-label small fw-semibold text-secondary">Default Value</label>
                                    <input type="text" id="optionDefault" class="form-control form-control-sm mb-3">
                                </div>

                                <div id="optionsWrapper" class="d-none mb-3">
                                    <label class="form-label small fw-semibold text-secondary">Options</label>
                                    <div id="optionsList"></div>
                                    <button type="button" class="btn btn-sm btn-outline-primary mt-2 w-100" onclick="addOption()">
                                        <i class="bi bi-plus me-1"></i>Add Option
                                    </button>
                                </div>

                                <button class="btn btn-danger btn-sm w-100 mt-2" onclick="deleteField(selectedFieldId)">
                                    <i class="bi bi-trash me-1"></i>Remove Field
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            {{-- Footer Buttons --}}
            <div class="d-flex justify-content-between mt-4">
                <button class="btn btn-outline-secondary" id="cancelBtn">
                    <i class="bi bi-x-circle me-1"></i>Clear Form
                </button>
                <button class="btn btn-primary px-4" id="nextBtn">
                    <i class="bi bi-code-slash me-1"></i>View JSON
                </button>
            </div>

        </div>
    </div>
</div>

{{-- JSON Modal --}}
<div class="modal fade" id="jsonModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content rounded-3">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">
                    <i class="bi bi-braces me-2 text-primary"></i>Form JSON Schema
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <pre id="jsonOutput" class="rounded-3"
                     style="max-height:450px; overflow:auto; background:#1e293b; color:#e2e8f0; padding:20px; font-size:13px; line-height:1.6;"></pre>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="copyJsonBtn">
                    <i class="bi bi-clipboard me-1"></i>Copy JSON
                </button>
            </div>
        </div>
    </div>
</div>

{{-- Preview Modal --}}
<div class="modal fade" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-3">
            <div class="modal-header border-0 pb-0">
                <div>
                    <h5 class="modal-title fw-bold">
                        <i class="bi bi-eye me-2 text-primary"></i>Form Preview
                    </h5>
                    <p class="text-muted small mb-0">This is exactly how your form will look to users</p>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4 py-4">
                <div id="previewContent"></div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="bi bi-pencil me-1"></i>Back to Editor
                </button>
            </div>
        </div>
    </div>
</div>

<style>

    /* ── Layout ── */
    .content-wrapper {
        margin-left: 260px !important;
        padding: 24px;
        padding-top: 70px !important;
        min-height: 100vh;
        box-sizing: border-box;
    }

    /* ── Header ── */
    .fb-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1e293b;
    }

    .bg-primary-soft {
        background-color: #eff6ff;
    }

    /* ── Canvas ── */
    .fb-canvas {
        min-height: 460px;
        background: #f8fafc;
        border: 2px dashed #cbd5e1;
        transition: all 0.2s ease;
    }

    .fb-canvas.drag-over {
        border-color: #3b82f6;
        background: #eff6ff;
        box-shadow: inset 0 0 0 4px rgba(59, 130, 246, 0.08);
    }

    /* ── Empty State ── */
    .fb-empty-icon {
        width: 64px;
        height: 64px;
        background: #eff6ff;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: #3b82f6;
        margin: 0 auto;
    }

    /* ── Field Cards ── */
    .field-card {
        background: #fff;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 14px 16px;
        margin-bottom: 12px;
        transition: box-shadow 0.15s ease, border-color 0.15s ease;
        position: relative;
        /* Slide-in animation */
        animation: slideIn 0.2s ease forwards;
    }

    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .field-card:hover {
        border-color: #93c5fd;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.1);
    }

    .field-card.selected {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.15);
    }

    /* drag-over state for reordering */
    .field-card.drag-over-card {
        border-color: #3b82f6;
        border-style: dashed;
        background: #eff6ff;
    }

    .field-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 10px;
    }

    .field-card-label {
        font-weight: 600;
        font-size: 0.875rem;
        color: #1e293b;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .field-card-label .badge-type {
        font-size: 10px;
        font-weight: 500;
        background: #f1f5f9;
        color: #64748b;
        padding: 2px 7px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .field-card-actions {
        display: flex;
        gap: 4px;
        align-items: center;
    }

    .field-card-actions .btn-icon {
        width: 30px;
        height: 30px;
        padding: 0;
        border: 1px solid #e2e8f0;
        background: #f8fafc;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        cursor: pointer;
        transition: all 0.15s;
        font-size: 13px;
    }

    .field-card-actions .btn-icon:hover {
        background: #fff;
        border-color: #93c5fd;
        color: #3b82f6;
    }

    .field-card-actions .btn-icon.btn-danger-soft:hover {
        border-color: #fca5a5;
        color: #ef4444;
        background: #fff;
    }

    .field-card-meta {
        font-size: 0.78rem;
        color: #94a3b8;
        margin-top: 4px;
    }

    .move-handle {
        cursor: grab;
        color: #94a3b8;
        font-size: 14px;
        margin-right: 6px;
        padding: 4px;
        border-radius: 4px;
        transition: all 0.15s;
    }

    .move-handle:hover {
        color: #3b82f6;
        background: #eff6ff;
    }

    .move-handle:active {
        cursor: grabbing;
    }

    /* ── Field Tiles ── */
    .field-tile {
        border: 1.5px solid #e2e8f0;
        background: #fff;
        padding: 10px 8px;
        border-radius: 10px;
        cursor: grab;
        text-align: center;
        font-size: 12px;
        font-weight: 500;
        color: #475569;
        transition: all 0.15s ease;
        user-select: none;
    }

    .field-tile:hover {
        background: #eff6ff;
        border-color: #3b82f6;
        color: #3b82f6;
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(59, 130, 246, 0.12);
    }

    .field-tile i {
        color: #3b82f6;
        display: block;
    }

    /* ── Border dashed util ── */
    .border-dashed { border-style: dashed !important; }

    /* ── Toast colors ── */
    .toast.toast-success { background-color: #22c55e; }
    .toast.toast-danger  { background-color: #ef4444; }
    .toast.toast-info    { background-color: #3b82f6; }

    /* ── Options panel controls ── */
    #fieldOptionsPanel .form-control {
        border-radius: 8px;
        border-color: #e2e8f0;
        font-size: 0.85rem;
    }
    #fieldOptionsPanel .form-control:focus {
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59,130,246,0.1);
    }

    /* ── Preview modal ── */
    .preview-field-wrap {
        margin-bottom: 22px;
    }
    .preview-field-wrap label {
        font-weight: 600;
        font-size: 0.9rem;
        margin-bottom: 6px;
        display: block;
        color: #1e293b;
    }
    .preview-field-wrap .required-star {
        color: #ef4444;
        margin-left: 3px;
    }
    #previewContent h4 {
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
    }
    .preview-title-block {
        border-left: 4px solid #3b82f6;
        padding-left: 12px;
        margin-bottom: 20px;
    }

    /* ── Responsive ── */
    @media (max-width: 1024px) {
        .content-wrapper {
            margin-left: 70px !important;
            padding: 16px;
            padding-top: 80px !important;
        }
        .fb-header {
            flex-wrap: wrap;
            gap: 10px;
        }
        .field-card-actions {
            flex-wrap: wrap;
            gap: 3px;
        }
    }

    @media (max-width: 768px) {
        .col-lg-8,
        .col-lg-4 {
            width: 100% !important;
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }
        .fb-canvas {
            min-height: 300px;
        }
    }

</style>

<script>
    let draggedFieldType  = null;
    let draggedCardId     = null;  /* for reorder drag */
    let formFields        = [];
    let selectedFieldId   = null;
    let undoHistory       = [];

    const STORAGE_KEY = 'formBuilder_v1';

    const fieldLabels = {
        text:'Text Input', textarea:'Text Area', number:'Number Input',
        email:'Email Input', phone:'Phone Input', dropdown:'Dropdown',
        radio:'Radio Buttons', checkbox:'Checkboxes', date:'Date Picker',
        file:'File Upload', title:'Title', description:'Description',
        newline:'New Line', pagebreak:'Page Break', hidden:'Hidden Field',
        state:'State', city:'City', statecity:'State & City',
    };

    const fieldIcons = {
        text:'bi-input-cursor-text', textarea:'bi-textarea-resize',
        number:'bi-123', email:'bi-envelope', phone:'bi-telephone',
        dropdown:'bi-menu-button-wide', radio:'bi-ui-radios',
        checkbox:'bi-ui-checks', date:'bi-calendar3',
        file:'bi-file-earmark-arrow-up', title:'bi-type-h1',
        description:'bi-text-paragraph', newline:'bi-arrow-return-left',
        pagebreak:'bi-scissors', hidden:'bi-eye-slash',
        state:'bi-map', city:'bi-building', statecity:'bi-geo-alt',
    };

    /* ────────────────────────────────
       TOAST
    ──────────────────────────────── */
    function showToast(message, type = 'success') {
        const toast = document.getElementById('appToast');
        const msg   = document.getElementById('toastMessage');
        toast.className = `toast align-items-center text-white border-0 toast-${type}`;
        msg.textContent = message;
        new bootstrap.Toast(toast, { delay: 2500 }).show();
    }

    /* ────────────────────────────────
       UNDO  (Ctrl/Cmd + Z)
    ──────────────────────────────── */
    function saveHistory() {
        undoHistory.push(JSON.stringify(formFields));
        if (undoHistory.length > 30) undoHistory.shift();
    }

    document.addEventListener('keydown', function(e) {
        if ((e.ctrlKey || e.metaKey) && e.key === 'z') {
            e.preventDefault();
            if (!undoHistory.length) { showToast('Nothing to undo', 'info'); return; }
            formFields = JSON.parse(undoHistory.pop());
            renderFields();
            saveForm();
            showToast('Undo successful', 'info');
        }
    });

    /* ────────────────────────────────
       LOCAL STORAGE
    ──────────────────────────────── */
    function saveForm() {
        localStorage.setItem(STORAGE_KEY, JSON.stringify({
            title: document.getElementById('formTitle').value,
            fields: formFields
        }));
    }

    function loadForm() {
        try {
            const saved = localStorage.getItem(STORAGE_KEY);
            if (!saved) return;
            const data = JSON.parse(saved);
            if (data.title) {
                document.getElementById('formTitle').value = data.title;
                document.getElementById('titleCount').textContent = data.title.length;
            }
            if (data.fields && data.fields.length) {
                formFields = data.fields;
                renderFields();
                showToast(`Restored ${formFields.length} field(s) from last session`, 'info');
            }
        } catch(e) {}
    }

    /* ────────────────────────────────
       TITLE COUNTER
    ──────────────────────────────── */
    document.getElementById('formTitle').addEventListener('input', function () {
        document.getElementById('titleCount').textContent = this.value.length;
        saveForm();
    });

    /* ────────────────────────────────
       DRAG FROM TILES  →  CANVAS
    ──────────────────────────────── */
    document.querySelectorAll('.field-tile').forEach(tile => {
        tile.addEventListener('dragstart', function () {
            draggedFieldType = this.dataset.type;
            draggedCardId    = null;
        });
    });

    const dropCanvas = document.getElementById('dropCanvas');

    dropCanvas.addEventListener('dragover', e => {
        e.preventDefault();
        /* only highlight canvas when dragging a NEW tile, not reordering */
        if (draggedFieldType) dropCanvas.classList.add('drag-over');
    });

    dropCanvas.addEventListener('dragleave', () => {
        dropCanvas.classList.remove('drag-over');
    });

    dropCanvas.addEventListener('drop', e => {
        e.preventDefault();
        dropCanvas.classList.remove('drag-over');

        if (!draggedFieldType) return;   /* reorder handled by card listeners */

        saveHistory();

        const newField = {
            id: Date.now(),
            type: draggedFieldType,
            label: fieldLabels[draggedFieldType],
            placeholder: '',
            cssClass: '',
            required: false,
            options: ['Option 1', 'Option 2'],
            min: '', max: '', defaultValue: '',
        };

        formFields.push(newField);
        draggedFieldType = null;
        renderFields();
        saveForm();
        showToast(`"${newField.label}" added`, 'success');
    });

    /* ────────────────────────────────
       RENDER
    ──────────────────────────────── */
    function updateFieldCount() {
        document.getElementById('fieldCount').textContent = formFields.length;
    }

    function renderFields() {
        updateFieldCount();
        dropCanvas.innerHTML = '';

        if (formFields.length === 0) {
            dropCanvas.innerHTML = `
                <div class="fb-empty text-center py-5">
                    <div class="fb-empty-icon mb-3"><i class="bi bi-layout-text-window-reverse"></i></div>
                    <h6 class="fw-semibold text-secondary mb-1">Your canvas is empty</h6>
                    <p class="text-muted small mb-3">Drag fields from the right panel to start building</p>
                    <div class="d-flex justify-content-center gap-3 flex-wrap">
                        <span class="badge bg-light text-secondary border"><i class="bi bi-input-cursor-text me-1"></i>Text</span>
                        <span class="badge bg-light text-secondary border"><i class="bi bi-menu-button-wide me-1"></i>Dropdown</span>
                        <span class="badge bg-light text-secondary border"><i class="bi bi-ui-radios me-1"></i>Radio</span>
                        <span class="badge bg-light text-secondary border"><i class="bi bi-file-earmark-arrow-up me-1"></i>File</span>
                    </div>
                </div>`;
            return;
        }

        formFields.forEach(field => {
            const card    = document.createElement('div');
            card.className = 'field-card' + (field.id === selectedFieldId ? ' selected' : '');
            card.dataset.id = field.id;

            /* ── make card draggable for reordering ── */
            card.setAttribute('draggable', 'true');

            card.addEventListener('dragstart', function(e) {
                draggedCardId    = field.id;
                draggedFieldType = null;
                e.dataTransfer.effectAllowed = 'move';
                setTimeout(() => card.style.opacity = '0.4', 0);
            });

            card.addEventListener('dragend', function() {
                card.style.opacity = '1';
                document.querySelectorAll('.field-card').forEach(c => c.classList.remove('drag-over-card'));
            });

            card.addEventListener('dragover', function(e) {
                e.preventDefault();
                if (draggedCardId && draggedCardId !== field.id) {
                    document.querySelectorAll('.field-card').forEach(c => c.classList.remove('drag-over-card'));
                    card.classList.add('drag-over-card');
                }
            });

            card.addEventListener('drop', function(e) {
                e.preventDefault();
                e.stopPropagation();
                card.classList.remove('drag-over-card');

                if (!draggedCardId || draggedCardId === field.id) return;

                saveHistory();

                const fromIndex = formFields.findIndex(f => f.id === draggedCardId);
                const toIndex   = formFields.findIndex(f => f.id === field.id);

                const [moved] = formFields.splice(fromIndex, 1);
                formFields.splice(toIndex, 0, moved);

                draggedCardId = null;
                renderFields();
                saveForm();
                showToast('Field reordered', 'info');
            });

            const icon    = fieldIcons[field.type] || 'bi-input-cursor';
            const isFirst = formFields[0].id === field.id;
            const isLast  = formFields[formFields.length - 1].id === field.id;

            let metaHint = '';
            if (field.placeholder) metaHint = `Placeholder: "${field.placeholder}"`;
            else if (['dropdown','radio','checkbox'].includes(field.type)) metaHint = `${field.options.length} options`;

            card.innerHTML = `
                <div class="field-card-header">
                    <div class="field-card-label">
                        <span class="move-handle" title="Drag to reorder">
                            <i class="bi bi-grip-vertical"></i>
                        </span>
                        <i class="bi ${icon} text-primary"></i>
                        ${field.label}
                        ${field.required ? '<span class="text-danger ms-1">*</span>' : ''}
                        <span class="badge-type">${field.type}</span>
                    </div>
                    <div class="field-card-actions">
                        <button class="btn-icon" title="Move up"   onclick="moveUp(${field.id})"       ${isFirst ? 'disabled' : ''}>
                            <i class="bi bi-chevron-up"></i>
                        </button>
                        <button class="btn-icon" title="Move down" onclick="moveDown(${field.id})"     ${isLast  ? 'disabled' : ''}>
                            <i class="bi bi-chevron-down"></i>
                        </button>
                        <button class="btn-icon" title="Edit"      onclick="editField(${field.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn-icon" title="Duplicate" onclick="duplicateField(${field.id})">
                            <i class="bi bi-copy"></i>
                        </button>
                        <button class="btn-icon btn-danger-soft" title="Delete" onclick="deleteField(${field.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
                ${metaHint ? `<div class="field-card-meta"><i class="bi bi-info-circle me-1"></i>${metaHint}</div>` : ''}
                <div class="mt-2">${getFieldPreview(field)}</div>`;

            dropCanvas.appendChild(card);
        });
    }

    /* ────────────────────────────────
       FIELD PREVIEW  (disabled inputs in canvas)
    ──────────────────────────────── */
    function getFieldPreview(field) {
        const cls = `form-control form-control-sm ${field.cssClass}`;
        if (field.type === 'textarea')    return `<textarea class="${cls}" placeholder="${field.placeholder}" disabled rows="2"></textarea>`;
        if (field.type === 'dropdown')    return `<select class="${cls}" disabled>${field.options.map(o=>`<option>${o}</option>`).join('')}</select>`;
        if (field.type === 'radio')       return `<div class="d-flex flex-wrap gap-2">${field.options.map(o=>`<label class="d-flex align-items-center gap-1 small text-muted"><input type="radio" disabled> ${o}</label>`).join('')}</div>`;
        if (field.type === 'checkbox')    return `<div class="d-flex flex-wrap gap-2">${field.options.map(o=>`<label class="d-flex align-items-center gap-1 small text-muted"><input type="checkbox" disabled> ${o}</label>`).join('')}</div>`;
        if (field.type === 'date')        return `<input type="date" class="${cls}" disabled>`;
        if (field.type === 'file')        return `<input type="file" class="${cls}" disabled>`;
        if (field.type === 'title')       return `<h4 class="fw-bold mb-0 text-dark">${field.label}</h4>`;
        if (field.type === 'description') return `<p class="mb-0 text-muted small">${field.defaultValue || 'Description text...'}</p>`;
        if (field.type === 'newline')     return `<div class="py-1 text-muted small fst-italic"><i class="bi bi-arrow-return-left me-1"></i>Line break</div>`;
        if (field.type === 'pagebreak')   return `<hr style="border-top:2px dashed #cbd5e1;" class="my-1">`;
        if (field.type === 'hidden')      return `<div class="d-flex align-items-center gap-2 text-muted small"><i class="bi bi-eye-slash"></i><span>Hidden value: "${field.defaultValue||''}"</span></div>`;
        if (field.type === 'state')       return `<select class="${cls}" disabled><option>Gujarat</option><option>Maharashtra</option></select>`;
        if (field.type === 'city')        return `<select class="${cls}" disabled><option>Ahmedabad</option><option>Rajkot</option></select>`;
        if (field.type === 'statecity')   return `<div class="row g-2"><div class="col-6"><select class="${cls}" disabled><option>State</option></select></div><div class="col-6"><select class="${cls}" disabled><option>City</option></select></div></div>`;
        return `<input type="${field.type}" class="${cls}" placeholder="${field.placeholder}" disabled>`;
    }

    /* ────────────────────────────────
       FORM PREVIEW MODAL  (live interactive)
    ──────────────────────────────── */
    function getPreviewHTML(field) {
        const req = field.required ? '<span class="required-star">*</span>' : '';

        if (field.type === 'title')       return `<div class="preview-title-block"><h4>${field.label}</h4></div>`;
        if (field.type === 'description') return `<p class="text-muted mb-3">${field.defaultValue || 'Description text'}</p>`;
        if (field.type === 'newline')     return `<div style="height:12px"></div>`;
        if (field.type === 'pagebreak')   return `<hr class="my-3">`;
        if (field.type === 'hidden')      return '';

        let input = '';
        if (field.type === 'textarea')
            input = `<textarea class="form-control" placeholder="${field.placeholder}" rows="3"></textarea>`;
        else if (field.type === 'dropdown')
            input = `<select class="form-select"><option value="">Select an option...</option>${field.options.map(o=>`<option>${o}</option>`).join('')}</select>`;
        else if (field.type === 'radio')
            input = `<div class="mt-1">${field.options.map(o=>`<div class="form-check"><input class="form-check-input" type="radio" name="radio_${field.id}"><label class="form-check-label">${o}</label></div>`).join('')}</div>`;
        else if (field.type === 'checkbox')
            input = `<div class="mt-1">${field.options.map(o=>`<div class="form-check"><input class="form-check-input" type="checkbox"><label class="form-check-label">${o}</label></div>`).join('')}</div>`;
        else if (field.type === 'date')
            input = `<input type="date" class="form-control">`;
        else if (field.type === 'file')
            input = `<input type="file" class="form-control">`;
        else if (field.type === 'state')
            input = `<select class="form-select"><option>Gujarat</option><option>Maharashtra</option></select>`;
        else if (field.type === 'city')
            input = `<select class="form-select"><option>Ahmedabad</option><option>Rajkot</option></select>`;
        else if (field.type === 'statecity')
            input = `<div class="row g-2"><div class="col-6"><select class="form-select"><option>State</option></select></div><div class="col-6"><select class="form-select"><option>City</option></select></div></div>`;
        else
            input = `<input type="${field.type}" class="form-control" placeholder="${field.placeholder}">`;

        return `<div class="preview-field-wrap">
            <label>${field.label}${req}</label>
            ${input}
        </div>`;
    }

    document.getElementById('previewBtn').addEventListener('click', function () {
        if (formFields.length === 0) {
            showToast('Add some fields first to preview', 'info');
            return;
        }
        const title = document.getElementById('formTitle').value || 'Untitled Form';
        const html  = `
            <div class="mb-4 pb-3 border-bottom">
                <h3 class="fw-bold text-dark">${title}</h3>
                <p class="text-muted small mb-0"><i class="bi bi-info-circle me-1"></i>This is a live preview — fields are fully interactive</p>
            </div>
            ${formFields.map(f => getPreviewHTML(f)).join('')}
            <div class="mt-4 pt-3 border-top">
                <button class="btn btn-primary px-4" onclick="showToast('This is just a preview!', 'info')">
                    <i class="bi bi-send me-1"></i>Submit Form
                </button>
            </div>`;
        document.getElementById('previewContent').innerHTML = html;
        new bootstrap.Modal(document.getElementById('previewModal')).show();
    });

    /* ────────────────────────────────
       OPTIONS LIST  (dropdown / radio / checkbox)
    ──────────────────────────────── */
    function renderOptionsList(field) {
        const list = document.getElementById('optionsList');
        list.innerHTML = '';
        field.options.forEach((option, index) => {
            list.innerHTML += `
                <div class="input-group input-group-sm mb-2">
                    <input type="text" class="form-control" value="${option}" oninput="updateOption(${index}, this.value)">
                    <button type="button" class="btn btn-outline-danger" onclick="removeOption(${index})">
                        <i class="bi bi-x"></i>
                    </button>
                </div>`;
        });
    }

    function updateOption(index, value) {
        const field = formFields.find(f => f.id === selectedFieldId);
        if (!field) return;
        field.options[index] = value;
        renderFields(); saveForm();
    }

    function addOption() {
        const field = formFields.find(f => f.id === selectedFieldId);
        if (!field) return;
        field.options.push('New Option');
        renderOptionsList(field); renderFields(); saveForm();
    }

    function removeOption(index) {
        const field = formFields.find(f => f.id === selectedFieldId);
        if (!field) return;
        field.options.splice(index, 1);
        renderOptionsList(field); renderFields(); saveForm();
    }

    /* ────────────────────────────────
       EDIT
    ──────────────────────────────── */
    function editField(id) {
        selectedFieldId = id;
        const field = formFields.find(f => f.id === id);
        if (!field) return;

        const isOptionField = ['dropdown','radio','checkbox'].includes(field.type);

        document.getElementById('addFieldsPanel').classList.add('d-none');
        document.getElementById('fieldOptionsPanel').classList.remove('d-none');
        document.getElementById('addFieldsTab').classList.remove('active');
        document.getElementById('fieldOptionsTab').classList.add('active');

        document.getElementById('optionLabel').value       = field.label;
        document.getElementById('optionPlaceholder').value = field.placeholder || '';
        document.getElementById('optionClass').value       = field.cssClass || '';
        document.getElementById('optionRequired').checked  = field.required || false;
        document.getElementById('optionMin').value         = field.min || '';
        document.getElementById('optionMax').value         = field.max || '';
        document.getElementById('optionDefault').value     = field.defaultValue || '';

        document.getElementById('optionsWrapper').classList.toggle('d-none', !isOptionField);
        if (isOptionField) renderOptionsList(field);

        renderFields();
    }

    /* ────────────────────────────────
       DUPLICATE
    ──────────────────────────────── */
    function duplicateField(id) {
        saveHistory();
        const index = formFields.findIndex(f => f.id === id);
        if (index === -1) return;
        const copy = { ...formFields[index], id: Date.now() };
        formFields.splice(index + 1, 0, copy);
        renderFields(); saveForm();
        showToast(`"${copy.label}" duplicated`, 'info');
    }

    /* ────────────────────────────────
       DELETE
    ──────────────────────────────── */
    function deleteField(id) {
        const field = formFields.find(f => f.id === id);
        if (!field) return;
        if (!confirm(`Delete "${field.label}"? This cannot be undone.`)) return;

        saveHistory();
        formFields = formFields.filter(f => f.id !== id);
        if (selectedFieldId === id) { selectedFieldId = null; showAddFieldsPanel(); }
        renderFields(); saveForm();
        showToast(`"${field.label}" deleted`, 'danger');
    }

    /* ────────────────────────────────
       UPDATE SELECTED FIELD
    ──────────────────────────────── */
    function updateSelectedField() {
        const field = formFields.find(f => f.id === selectedFieldId);
        if (!field) return;
        field.label        = document.getElementById('optionLabel').value;
        field.placeholder  = document.getElementById('optionPlaceholder').value;
        field.cssClass     = document.getElementById('optionClass').value;
        field.required     = document.getElementById('optionRequired').checked;
        field.min          = document.getElementById('optionMin').value;
        field.max          = document.getElementById('optionMax').value;
        field.defaultValue = document.getElementById('optionDefault').value;
        renderFields(); saveForm();
    }

    ['optionLabel','optionPlaceholder','optionClass','optionMin','optionMax','optionDefault']
        .forEach(id => document.getElementById(id).addEventListener('input', updateSelectedField));
    document.getElementById('optionRequired').addEventListener('change', updateSelectedField);

    /* ────────────────────────────────
       TAB SWITCHING
    ──────────────────────────────── */
    document.getElementById('addFieldsTab').addEventListener('click', showAddFieldsPanel);
    document.getElementById('fieldOptionsTab').addEventListener('click', function () {
        if (!selectedFieldId) { showToast('Click ✏️ on a field to edit it first', 'info'); return; }
        document.getElementById('addFieldsPanel').classList.add('d-none');
        document.getElementById('fieldOptionsPanel').classList.remove('d-none');
        document.getElementById('addFieldsTab').classList.remove('active');
        document.getElementById('fieldOptionsTab').classList.add('active');
    });

    function showAddFieldsPanel() {
        selectedFieldId = null;
        document.getElementById('addFieldsPanel').classList.remove('d-none');
        document.getElementById('fieldOptionsPanel').classList.add('d-none');
        document.getElementById('addFieldsTab').classList.add('active');
        document.getElementById('fieldOptionsTab').classList.remove('active');
        renderFields();
    }

    /* ────────────────────────────────
       MOVE UP / DOWN
    ──────────────────────────────── */
    function moveUp(id) {
        const i = formFields.findIndex(f => f.id === id);
        if (i <= 0) return;
        saveHistory();
        [formFields[i], formFields[i-1]] = [formFields[i-1], formFields[i]];
        renderFields(); saveForm();
    }

    function moveDown(id) {
        const i = formFields.findIndex(f => f.id === id);
        if (i === -1 || i === formFields.length - 1) return;
        saveHistory();
        [formFields[i], formFields[i+1]] = [formFields[i+1], formFields[i]];
        renderFields(); saveForm();
    }

    /* ────────────────────────────────
       VIEW JSON  (with validation)
    ──────────────────────────────── */
    document.getElementById('nextBtn').addEventListener('click', function () {
        const title = document.getElementById('formTitle').value.trim();

        if (!title) {
            showToast('Please enter a form title first', 'danger');
            document.getElementById('formTitle').focus();
            document.getElementById('formTitle').style.borderColor = '#ef4444';
            setTimeout(() => document.getElementById('formTitle').style.borderColor = '#e2e8f0', 2000);
            return;
        }

        if (formFields.length === 0) {
            showToast('Add at least one field before exporting', 'danger');
            return;
        }

        const schema = { title, fields: formFields };
        document.getElementById('jsonOutput').textContent = JSON.stringify(schema, null, 2);
        new bootstrap.Modal(document.getElementById('jsonModal')).show();
    });

    /* ────────────────────────────────
       COPY JSON
    ──────────────────────────────── */
    document.getElementById('copyJsonBtn').addEventListener('click', function () {
        const text = document.getElementById('jsonOutput').textContent;
        navigator.clipboard.writeText(text).then(() => {
            this.innerHTML = '<i class="bi bi-clipboard-check me-1"></i>Copied!';
            setTimeout(() => { this.innerHTML = '<i class="bi bi-clipboard me-1"></i>Copy JSON'; }, 2000);
            showToast('JSON copied to clipboard', 'success');
        });
    });

    /* ────────────────────────────────
       CLEAR FORM
    ──────────────────────────────── */
    document.getElementById('cancelBtn').addEventListener('click', function () {
        if (!confirm('Clear the entire form? This cannot be undone.')) return;
        saveHistory();
        formFields = []; selectedFieldId = null;
        document.getElementById('formTitle').value = '';
        document.getElementById('titleCount').textContent = '0';
        showAddFieldsPanel(); renderFields();
        localStorage.removeItem(STORAGE_KEY);
        showToast('Form cleared', 'danger');
    });

    /* ── Boot ── */
    loadForm();
</script>

@endsection