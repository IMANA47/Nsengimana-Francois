@extends('admin.layout', ['title' => 'AI Agent Management'])

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="text-brand"><i class="bi bi-robot me-2"></i>AI Agent Management</h1>
    <div>
        <button class="btn btn-brand btn-sm" onclick="refreshMemory()">
            <i class="bi bi-arrow-clockwise me-1"></i>Refresh Memory
        </button>
        <button class="btn btn-success btn-sm" onclick="exportMemory()">
            <i class="bi bi-download me-1"></i>Export
        </button>
    </div>
</div>

<div class="row">
    <!-- Memory Categories -->
    <div class="col-md-3">
        <div class="card bg-dark border-secondary">
            <div class="card-header">
                <h6 class="mb-0">Categories</h6>
            </div>
            <div class="card-body p-0">
                <div class="list-group list-group-flush">
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item active" data-category="all">
                        <i class="bi bi-grid me-2"></i>All Categories
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="profile">
                        <i class="bi bi-person me-2"></i>Profile
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="skills">
                        <i class="bi bi-code-slash me-2"></i>Skills
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="projects">
                        <i class="bi bi-folder me-2"></i>Projects
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="experience">
                        <i class="bi bi-briefcase me-2"></i>Experience
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="services">
                        <i class="bi bi-gear me-2"></i>Services
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="contact">
                        <i class="bi bi-envelope me-2"></i>Contact
                    </a>
                    <a href="#" class="list-group-item list-group-item-action bg-dark text-white border-secondary category-item" data-category="ai_config">
                        <i class="bi bi-robot me-2"></i>AI Config
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Memory Items -->
    <div class="col-md-9">
        <div class="card bg-dark border-secondary">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0">Memory Items</h6>
                <button class="btn btn-sm btn-brand" onclick="addMemoryItem()">
                    <i class="bi bi-plus me-1"></i>Add Item
                </button>
            </div>
            <div class="card-body">
                <div id="memoryItems" class="memory-items-container">
                    <!-- Memory items will be loaded here -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Memory Modal -->
<div class="modal fade" id="memoryModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content bg-dark text-white">
            <div class="modal-header border-secondary">
                <h5 class="modal-title" id="memoryModalTitle">Add Memory Item</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="memoryForm">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-warning">Category</label>
                                <select id="memoryCategory" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="profile">Profile</option>
                                    <option value="skills">Skills</option>
                                    <option value="projects">Projects</option>
                                    <option value="experience">Experience</option>
                                    <option value="services">Services</option>
                                    <option value="contact">Contact</option>
                                    <option value="certifications">Certifications</option>
                                    <option value="ai_config">AI Config</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label text-warning">Key</label>
                                <input type="text" id="memoryKey" class="form-control" placeholder="e.g., laravel, php, identity" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label text-warning">Priority</label>
                                <input type="number" id="memoryPriority" class="form-control" min="1" max="10" value="1">
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="mb-3">
                                <label class="form-label text-warning">Data (JSON)</label>
                                <textarea id="memoryData" class="form-control" rows="8" placeholder='{"name": "Laravel", "level": "Expert", "years": "5+"}' required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="memoryActive" checked>
                            <label class="form-check-label" for="memoryActive">
                                Active
                            </label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer border-secondary">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-brand" onclick="saveMemoryItem()">Save</button>
            </div>
        </div>
    </div>
</div>

<script>
let currentCategory = 'all';
let memoryItems = [];

// Load memory items on page load
document.addEventListener('DOMContentLoaded', function() {
    loadMemoryItems();
    
    // Category click handlers
    document.querySelectorAll('.category-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            document.querySelectorAll('.category-item').forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            currentCategory = this.dataset.category;
            filterMemoryItems();
        });
    });
});

function loadMemoryItems() {
    fetch('/api/ai/memory-items')
        .then(response => response.json())
        .then(data => {
            memoryItems = data;
            displayMemoryItems();
        })
        .catch(error => {
            console.error('Error loading memory items:', error);
            showAlert('Error loading memory items', 'danger');
        });
}

function displayMemoryItems() {
    const container = document.getElementById('memoryItems');
    const filteredItems = currentCategory === 'all' 
        ? memoryItems 
        : memoryItems.filter(item => item.category === currentCategory);
    
    if (filteredItems.length === 0) {
        container.innerHTML = '<p class="text-muted text-center">No memory items found for this category.</p>';
        return;
    }
    
    let html = '';
    filteredItems.forEach(item => {
        html += `
            <div class="memory-item border-secondary rounded p-3 mb-3">
                <div class="d-flex justify-content-between align-items-start">
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center mb-2">
                            <span class="badge bg-brand text-dark me-2">${item.category}</span>
                            <strong class="text-white">${item.key}</strong>
                            <span class="badge bg-secondary ms-2">Priority: ${item.priority}</span>
                            ${!item.active ? '<span class="badge bg-danger ms-2">Inactive</span>' : ''}
                        </div>
                        <pre class="text-muted small mb-0">${JSON.stringify(item.data, null, 2)}</pre>
                    </div>
                    <div class="ms-3">
                        <button class="btn btn-sm btn-outline-light me-1" onclick="editMemoryItem(${item.id})">
                            <i class="bi bi-pencil"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-danger" onclick="deleteMemoryItem(${item.id})">
                            <i class="bi bi-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

function filterMemoryItems() {
    displayMemoryItems();
}

function addMemoryItem() {
    document.getElementById('memoryModalTitle').textContent = 'Add Memory Item';
    document.getElementById('memoryForm').reset();
    document.getElementById('memoryActive').checked = true;
    new bootstrap.Modal(document.getElementById('memoryModal')).show();
}

function editMemoryItem(id) {
    const item = memoryItems.find(i => i.id === id);
    if (!item) return;
    
    document.getElementById('memoryModalTitle').textContent = 'Edit Memory Item';
    document.getElementById('memoryCategory').value = item.category;
    document.getElementById('memoryKey').value = item.key;
    document.getElementById('memoryPriority').value = item.priority;
    document.getElementById('memoryData').value = JSON.stringify(item.data, null, 2);
    document.getElementById('memoryActive').checked = item.active;
    
    const modal = new bootstrap.Modal(document.getElementById('memoryModal'));
    modal.show();
    
    // Store current edit ID
    document.getElementById('memoryForm').dataset.editId = id;
}

function saveMemoryItem() {
    const form = document.getElementById('memoryForm');
    const editId = form.dataset.editId;
    
    try {
        const data = {
            category: document.getElementById('memoryCategory').value,
            key: document.getElementById('memoryKey').value,
            priority: parseInt(document.getElementById('memoryPriority').value),
            data: JSON.parse(document.getElementById('memoryData').value),
            active: document.getElementById('memoryActive').checked
        };
        
        const url = editId ? `/api/ai/memory-items/${editId}` : '/api/ai/memory-items';
        const method = editId ? 'PUT' : 'POST';
        
        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.success) {
                showAlert(editId ? 'Memory item updated successfully' : 'Memory item added successfully', 'success');
                bootstrap.Modal.getInstance(document.getElementById('memoryModal')).hide();
                loadMemoryItems();
                delete form.dataset.editId;
            } else {
                showAlert(result.message || 'Error saving memory item', 'danger');
            }
        })
        .catch(error => {
            console.error('Error saving memory item:', error);
            showAlert('Error saving memory item', 'danger');
        });
        
    } catch (error) {
        showAlert('Invalid JSON data format', 'danger');
    }
}

function deleteMemoryItem(id) {
    if (!confirm('Are you sure you want to delete this memory item?')) return;
    
    fetch(`/api/ai/memory-items/${id}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showAlert('Memory item deleted successfully', 'success');
            loadMemoryItems();
        } else {
            showAlert(result.message || 'Error deleting memory item', 'danger');
        }
    })
    .catch(error => {
        console.error('Error deleting memory item:', error);
        showAlert('Error deleting memory item', 'danger');
    });
}

function refreshMemory() {
    fetch('/api/ai/refresh-memory', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            showAlert('AI memory refreshed successfully', 'success');
            loadMemoryItems();
        } else {
            showAlert(result.message || 'Error refreshing memory', 'danger');
        }
    })
    .catch(error => {
        console.error('Error refreshing memory:', error);
        showAlert('Error refreshing memory', 'danger');
    });
}

function exportMemory() {
    const dataStr = JSON.stringify(memoryItems, null, 2);
    const dataBlob = new Blob([dataStr], {type: 'application/json'});
    const url = URL.createObjectURL(dataBlob);
    const link = document.createElement('a');
    link.href = url;
    link.download = 'ai-memory-backup.json';
    link.click();
    URL.revokeObjectURL(url);
}

function showAlert(message, type) {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    const container = document.querySelector('.container');
    container.insertBefore(alertDiv, container.firstChild);
    
    setTimeout(() => {
        alertDiv.remove();
    }, 5000);
}
</script>

<style>
.memory-item {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.memory-item:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(255, 215, 0, 0.3);
}

.memory-item pre {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 4px;
    padding: 8px;
    max-height: 200px;
    overflow-y: auto;
}

.category-item {
    transition: all 0.3s ease;
}

.category-item:hover {
    background: rgba(255, 215, 0, 0.1) !important;
}

.category-item.active {
    background: rgba(255, 215, 0, 0.2) !important;
    border-color: rgba(255, 215, 0, 0.4) !important;
}

.modal-content {
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.form-control {
    background: rgba(0, 0, 0, 0.3);
    border: 1px solid rgba(255, 255, 255, 0.1);
}

.form-control:focus {
    background: rgba(0, 0, 0, 0.3);
    border-color: rgba(255, 215, 0, 0.4);
}
</style>
@endsection
