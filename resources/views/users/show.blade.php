@extends('layouts.admin')

@section('content')
<div class="page">
    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            <a href="{{ route('admin.users.index') }}" class="text-muted">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-arrow-left" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 12l14 0"></path>
                                    <path d="M5 12l6 6"></path>
                                    <path d="M5 12l6 -6"></path>
                                </svg>
                                Retour à la liste
                            </a>
                        </div>
                        <h2 class="page-title">
                            <span class="avatar avatar-md me-2">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            {{ $user->name }}
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <button class="btn btn-primary" onclick="showEditModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                    <path d="M16 5l3 3"></path>
                                </svg>
                                Modifier
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <!-- Informations de base -->
                    <div class="col-lg-8">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Informations de l'utilisateur</h3>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Nom</div>
                                    <div class="col-md-8"><strong>{{ $user->name }}</strong></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Email</div>
                                    <div class="col-md-8">
                                        <a href="mailto:{{ $user->email }}">{{ $user->email }}</a>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Date de création</div>
                                    <div class="col-md-8">{{ $user->created_at->format('d/m/Y à H:i') }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Dernière modification</div>
                                    <div class="col-md-8">{{ $user->updated_at->format('d/m/Y à H:i') }}</div>
                                </div>
                                @if($user->email_verified_at)
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Email vérifié</div>
                                    <div class="col-md-8">
                                        <span class="badge bg-success">Oui</span>
                                        <span class="text-muted ms-2">{{ $user->email_verified_at->format('d/m/Y à H:i') }}</span>
                                    </div>
                                </div>
                                @else
                                <div class="row mb-3">
                                    <div class="col-md-4 text-muted">Email vérifié</div>
                                    <div class="col-md-8">
                                        <span class="badge bg-warning">Non</span>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Rôles et permissions -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Rôles</h3>
                            </div>
                            <div class="card-body">
                                @if($user->roles->count() > 0)
                                    <div class="list-group list-group-flush">
                                        @foreach($user->roles as $role)
                                            <div class="list-group-item">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-blue-lt flex-fill">{{ $role->name }}</span>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <p class="text-muted">Aucun rôle assigné</p>
                                @endif
                            </div>
                        </div>

                        @if($user->permissions->count() > 0)
                        <div class="card mt-3">
                            <div class="card-header">
                                <h3 class="card-title">Permissions directes</h3>
                            </div>
                            <div class="card-body">
                                <div class="list-group list-group-flush">
                                    @foreach($user->permissions as $permission)
                                        <div class="list-group-item">
                                            <div class="text-truncate">
                                                <span class="badge bg-green-lt">{{ $permission->name }}</span>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal d'édition -->
<div class="modal modal-blur fade" id="edit-user-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier l'utilisateur</h5>
                <button type="button" class="btn-close" onclick="closeEditModal()" aria-label="Close"></button>
            </div>
            <form id="edit-user-form">
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required">Nom</label>
                        <input type="text" class="form-control" name="name" id="edit-name" value="{{ $user->name }}" required>
                        <div class="invalid-feedback" id="edit-name-error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required">Email</label>
                        <input type="email" class="form-control" name="email" id="edit-email" value="{{ $user->email }}" required>
                        <div class="invalid-feedback" id="edit-email-error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nouveau mot de passe (laisser vide pour ne pas modifier)</label>
                        <input type="password" class="form-control" name="password" id="edit-password">
                        <div class="invalid-feedback" id="edit-password-error"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirmation du mot de passe</label>
                        <input type="password" class="form-control" name="password_confirmation" id="edit-password-confirmation">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rôles</label>
                        <div id="edit-roles-container">
                            <!-- Roles will be loaded dynamically -->
                        </div>
                        <div class="invalid-feedback" id="edit-roles-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" onclick="closeEditModal()">Annuler</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const userId = {{ $user->id }};
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const API_BASE = '/admin/users/api';

    let availableRoles = [];

    // Utility function
    function escapeHtml(text) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, m => map[m]);
    }

    // Load available roles
    async function loadRoles() {
        try {
            const response = await fetch('/admin/permissions/api/roles');
            const data = await response.json();
            availableRoles = data.roles || [];
        } catch (error) {
            console.error('Erreur lors du chargement des rôles:', error);
        }
    }

    // Show edit modal
    function showEditModal() {
        const modal = new bootstrap.Modal(document.getElementById('edit-user-modal'));
        
        // Populate roles
        const rolesContainer = document.getElementById('edit-roles-container');
        const userRoles = @json($user->roles->pluck('name'));
        
        rolesContainer.innerHTML = availableRoles.map(role => `
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="${escapeHtml(role.name)}" 
                       id="role-${role.id}" ${userRoles.includes(role.name) ? 'checked' : ''}>
                <label class="form-check-label" for="role-${role.id}">
                    ${escapeHtml(role.name)}
                </label>
            </div>
        `).join('');
        
        modal.show();
    }

    // Close edit modal
    function closeEditModal() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('edit-user-modal'));
        if (modal) {
            modal.hide();
        }
    }

    // Handle form submission
    document.getElementById('edit-user-form').addEventListener('submit', async (e) => {
        e.preventDefault();
        
        // Clear previous errors
        document.querySelectorAll('.is-invalid').forEach(el => el.classList.remove('is-invalid'));
        document.querySelectorAll('.invalid-feedback').forEach(el => el.textContent = '');
        
        const formData = {
            name: document.getElementById('edit-name').value,
            email: document.getElementById('edit-email').value,
            roles: Array.from(document.querySelectorAll('#edit-roles-container input[type="checkbox"]:checked'))
                .map(cb => cb.value)
        };
        
        const password = document.getElementById('edit-password').value;
        const passwordConfirmation = document.getElementById('edit-password-confirmation').value;
        
        if (password) {
            formData.password = password;
            formData.password_confirmation = passwordConfirmation;
        }
        
        try {
            const response = await fetch(`${API_BASE}/${userId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify(formData)
            });
            
            const data = await response.json();
            
            if (!response.ok) {
                if (data.errors) {
                    Object.keys(data.errors).forEach(field => {
                        const input = document.getElementById(`edit-${field}`);
                        const error = document.getElementById(`edit-${field}-error`);
                        if (input && error) {
                            input.classList.add('is-invalid');
                            error.textContent = data.errors[field][0];
                        }
                    });
                }
                throw new Error(data.message || 'Erreur lors de la modification');
            }
            
            closeEditModal();
            // Reload page to show updated data
            window.location.reload();
            
        } catch (error) {
            console.error('Erreur:', error);
            alert(error.message || 'Une erreur est survenue');
        }
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', async () => {
        await loadRoles();
    });
</script>
@endsection
