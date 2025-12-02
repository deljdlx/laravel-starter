<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Permissions - Laravel Starter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .permission-badge {
            margin: 2px;
            display: inline-block;
        }
        .role-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .role-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .permission-list {
            max-height: 300px;
            overflow-y: auto;
        }
        .search-box {
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="page">
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-lock" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z"></path>
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0"></path>
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4"></path>
                                </svg>
                                Gestion des Permissions
                            </h2>
                            <div class="text-secondary mt-1">
                                Gérer les rôles et permissions de l'application
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <!-- Users Section -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Utilisateurs</h3>
                                    <div class="ms-auto">
                                        <span class="badge bg-purple-lt" id="user-count">0</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="user-search" placeholder="Rechercher un utilisateur...">
                                    </div>
                                    <div id="users-container">
                                        <div class="text-center py-4">
                                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                            Chargement des utilisateurs...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Roles Section -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Rôles</h3>
                                    <div class="ms-auto">
                                        <span class="badge bg-blue-lt" id="role-count">0</span>
                                        <button class="btn btn-primary btn-sm ms-2" onclick="showCreateRoleModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                            Créer un rôle
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="role-search" placeholder="Rechercher un rôle...">
                                    </div>
                                    <div id="roles-container">
                                        <div class="text-center py-4">
                                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                            Chargement des rôles...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Permissions Section -->
                        <div class="col-lg-4">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Permissions</h3>
                                    <div class="ms-auto">
                                        <span class="badge bg-green-lt" id="permission-count">0</span>
                                        <button class="btn btn-primary btn-sm ms-2" onclick="showCreatePermissionModal()">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                                <path d="M12 5l0 14"></path>
                                                <path d="M5 12l14 0"></path>
                                            </svg>
                                            Créer une permission
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="permission-search" placeholder="Rechercher une permission...">
                                    </div>
                                    <div class="permission-list" id="permissions-container">
                                        <div class="text-center py-4">
                                            <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                            Chargement des permissions...
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit Role Modal -->
    <div class="modal" id="role-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="role-modal-title">Créer un rôle</h5>
                    <button type="button" class="btn-close" onclick="closeRoleModal()" aria-label="Close"></button>
                </div>
                <form id="role-form" onsubmit="submitRoleForm(event)">
                    <div class="modal-body">
                        <input type="hidden" id="role-id">
                        <div class="mb-3">
                            <label class="form-label required">Nom du rôle</label>
                            <input type="text" class="form-control" id="role-name" required placeholder="admin, editor, viewer...">
                            <div class="invalid-feedback" id="role-name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="role-guard-name" value="web" placeholder="web">
                            <small class="form-hint">Laisser vide pour utiliser 'web' par défaut</small>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Permissions associées</label>
                            <div id="role-permissions-list" class="border rounded p-3" style="max-height: 300px; overflow-y: auto;">
                                <div class="text-center text-muted">Chargement des permissions...</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" onclick="closeRoleModal()">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="role-submit-btn">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Create/Edit Permission Modal -->
    <div class="modal" id="permission-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="permission-modal-title">Créer une permission</h5>
                    <button type="button" class="btn-close" onclick="closePermissionModal()" aria-label="Close"></button>
                </div>
                <form id="permission-form" onsubmit="submitPermissionForm(event)">
                    <div class="modal-body">
                        <input type="hidden" id="permission-id">
                        <div class="mb-3">
                            <label class="form-label required">Nom de la permission</label>
                            <input type="text" class="form-control" id="permission-name" required placeholder="create-posts, edit-users...">
                            <div class="invalid-feedback" id="permission-name-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Guard Name</label>
                            <input type="text" class="form-control" id="permission-guard-name" value="web" placeholder="web">
                            <small class="form-hint">Laisser vide pour utiliser 'web' par défaut</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" onclick="closePermissionModal()">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="permission-submit-btn">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal" id="delete-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body text-center py-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12 9v4"></path>
                        <path d="M10.363 3.591l-8.106 13.534a1.914 1.914 0 0 0 1.636 2.871h16.214a1.914 1.914 0 0 0 1.636 -2.87l-8.106 -13.536a1.914 1.914 0 0 0 -3.274 0z"></path>
                        <path d="M12 16h.01"></path>
                    </svg>
                    <h3>Êtes-vous sûr ?</h3>
                    <div class="text-secondary" id="delete-message">Cette action est irréversible.</div>
                </div>
                <div class="modal-footer">
                    <div class="w-100">
                        <div class="row">
                            <div class="col">
                                <button type="button" class="btn w-100" onclick="closeDeleteModal()">Annuler</button>
                            </div>
                            <div class="col">
                                <button type="button" class="btn btn-danger w-100" id="confirm-delete-btn">Supprimer</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-backdrop" id="modal-backdrop" style="display: none;"></div>

    <script>
        // State
        let roles = [];
        let permissions = [];
        let users = [];
        let currentRole = null;
        let currentPermission = null;

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // API Base URLs
        const ROLES_API = '/permissions/api/roles';
        const PERMISSIONS_API = '/permissions/api/permissions';
        const USERS_API = '/permissions/api/users';

        // Utility Functions
        function escapeHtml(text) {
            const map = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };
            return String(text).replace(/[&<>"']/g, m => map[m]);
        }

        function showToast(message, type = 'success') {
            // Validate type parameter
            const allowedTypes = ['success', 'danger', 'warning', 'info'];
            const safeType = allowedTypes.includes(type) ? type : 'info';
            
            // Simple toast notification
            const toast = document.createElement('div');
            toast.className = `alert alert-${safeType} alert-dismissible position-fixed top-0 end-0 m-3`;
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                ${escapeHtml(message)}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            `;
            document.body.appendChild(toast);
            setTimeout(() => toast.remove(), 5000);
        }

        function openModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = document.getElementById('modal-backdrop');
            modal.style.display = 'block';
            backdrop.style.display = 'block';
            setTimeout(() => {
                modal.classList.add('show');
                backdrop.classList.add('show');
            }, 10);
            document.body.classList.add('modal-open');
        }

        function closeModal(modalId) {
            const modal = document.getElementById(modalId);
            const backdrop = document.getElementById('modal-backdrop');
            modal.classList.remove('show');
            backdrop.classList.remove('show');
            setTimeout(() => {
                modal.style.display = 'none';
                backdrop.style.display = 'none';
                document.body.classList.remove('modal-open');
            }, 150);
        }

        // Load Data Functions
        async function loadUsers() {
            try {
                const response = await fetch(USERS_API);
                const data = await response.json();
                users = data.users;
                displayUsers();
                document.getElementById('user-count').textContent = `${data.count} utilisateur${data.count !== 1 ? 's' : ''}`;
            } catch (error) {
                console.error('Error loading users:', error);
                showToast('Erreur lors du chargement des utilisateurs', 'danger');
            }
        }

        async function loadRoles() {
            try {
                const response = await fetch(ROLES_API);
                const data = await response.json();
                roles = data.roles;
                displayRoles();
                document.getElementById('role-count').textContent = `${data.count} rôle${data.count !== 1 ? 's' : ''}`;
            } catch (error) {
                console.error('Error loading roles:', error);
                showToast('Erreur lors du chargement des rôles', 'danger');
            }
        }

        async function loadPermissions() {
            try {
                const response = await fetch(PERMISSIONS_API);
                const data = await response.json();
                permissions = data.permissions;
                displayPermissions();
                document.getElementById('permission-count').textContent = `${data.count} permission${data.count !== 1 ? 's' : ''}`;
            } catch (error) {
                console.error('Error loading permissions:', error);
                showToast('Erreur lors du chargement des permissions', 'danger');
            }
        }

        // Display Functions
        function displayUsers(filter = '') {
            const container = document.getElementById('users-container');
            const filteredUsers = users.filter(user => 
                user.name.toLowerCase().includes(filter.toLowerCase()) ||
                user.email.toLowerCase().includes(filter.toLowerCase())
            );

            if (filteredUsers.length === 0) {
                container.innerHTML = '<div class="text-center text-muted py-4">Aucun utilisateur trouvé</div>';
                return;
            }

            container.innerHTML = filteredUsers.map(user => {
                const userRoles = user.roles || [];
                const allPermissions = [];
                
                // Collect all permissions from all roles
                userRoles.forEach(role => {
                    if (role.permissions) {
                        role.permissions.forEach(perm => {
                            if (!allPermissions.find(p => p.name === perm.name)) {
                                allPermissions.push(perm);
                            }
                        });
                    }
                });

                return `
                    <div class="card mb-2">
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="flex-fill">
                                    <div class="font-weight-medium">${escapeHtml(user.name)}</div>
                                    <div class="text-secondary small">${escapeHtml(user.email)}</div>
                                    ${userRoles.length > 0 ? `
                                        <div class="mt-2">
                                            <strong class="small">Rôles:</strong><br>
                                            ${userRoles.map(r => `<span class="badge bg-blue-lt me-1 mt-1">${escapeHtml(r.name)}</span>`).join('')}
                                        </div>
                                    ` : '<div class="mt-2 text-muted small">Aucun rôle</div>'}
                                    ${allPermissions.length > 0 ? `
                                        <div class="mt-2">
                                            <strong class="small">Permissions:</strong><br>
                                            ${allPermissions.map(p => `<span class="badge bg-green-lt me-1 mt-1">${escapeHtml(p.name)}</span>`).join('')}
                                        </div>
                                    ` : ''}
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function displayRoles(filter = '') {
            const container = document.getElementById('roles-container');
            const filteredRoles = roles.filter(role => 
                role.name.toLowerCase().includes(filter.toLowerCase())
            );

            if (filteredRoles.length === 0) {
                container.innerHTML = '<div class="text-center text-muted py-4">Aucun rôle trouvé</div>';
                return;
            }

            container.innerHTML = filteredRoles.map(role => `
                <div class="card role-card mb-2" onclick="showEditRoleModal(${role.id})">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="flex-fill">
                                <div class="font-weight-medium">${escapeHtml(role.name)}</div>
                                <div class="text-secondary small">
                                    ${role.permissions.length} permission${role.permissions.length !== 1 ? 's' : ''}
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-sm btn-icon btn-ghost-danger" onclick="event.stopPropagation(); confirmDeleteRole(${role.id}, '${escapeHtml(role.name)}')">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M4 7l16 0"></path>
                                        <path d="M10 11l0 6"></path>
                                        <path d="M14 11l0 6"></path>
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="mt-2">
                            ${role.permissions.map(p => `<span class="badge bg-blue-lt permission-badge">${escapeHtml(p.name)}</span>`).join('')}
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function displayPermissions(filter = '') {
            const container = document.getElementById('permissions-container');
            const filteredPermissions = permissions.filter(permission => 
                permission.name.toLowerCase().includes(filter.toLowerCase())
            );

            if (filteredPermissions.length === 0) {
                container.innerHTML = '<div class="text-center text-muted py-4">Aucune permission trouvée</div>';
                return;
            }

            container.innerHTML = filteredPermissions.map(permission => `
                <div class="d-flex align-items-center justify-content-between mb-2 p-2 rounded hover-shadow">
                    <div class="flex-fill">
                        <span class="badge bg-green-lt">${escapeHtml(permission.name)}</span>
                        <span class="text-secondary small ms-2">
                            ${permission.roles ? permission.roles.length : 0} rôle${permission.roles && permission.roles.length !== 1 ? 's' : ''}
                        </span>
                    </div>
                    <div>
                        <button class="btn btn-sm btn-icon btn-ghost-primary" onclick="showEditPermissionModal(${permission.id})">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"></path>
                                <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"></path>
                                <path d="M16 5l3 3"></path>
                            </svg>
                        </button>
                        <button class="btn btn-sm btn-icon btn-ghost-danger" onclick="confirmDeletePermission(${permission.id}, '${escapeHtml(permission.name)}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            `).join('');
        }

        function renderPermissionsCheckboxList() {
            const container = document.getElementById('role-permissions-list');
            if (permissions.length === 0) {
                container.innerHTML = '<div class="text-center text-muted">Aucune permission disponible</div>';
                return;
            }

            const currentPermissions = currentRole ? currentRole.permissions.map(p => p.name) : [];
            container.innerHTML = permissions.map(permission => `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${escapeHtml(permission.name)}" id="perm-${permission.id}" ${currentPermissions.includes(permission.name) ? 'checked' : ''}>
                    <label class="form-check-label" for="perm-${permission.id}">
                        ${escapeHtml(permission.name)}
                    </label>
                </div>
            `).join('');
        }

        // Role Modal Functions
        function showCreateRoleModal() {
            currentRole = null;
            document.getElementById('role-modal-title').textContent = 'Créer un rôle';
            document.getElementById('role-submit-btn').textContent = 'Créer';
            document.getElementById('role-form').reset();
            document.getElementById('role-id').value = '';
            document.getElementById('role-guard-name').value = 'web';
            renderPermissionsCheckboxList();
            openModal('role-modal');
        }

        async function showEditRoleModal(roleId) {
            currentRole = roles.find(r => r.id === roleId);
            if (!currentRole) return;

            document.getElementById('role-modal-title').textContent = 'Modifier le rôle';
            document.getElementById('role-submit-btn').textContent = 'Modifier';
            document.getElementById('role-id').value = currentRole.id;
            document.getElementById('role-name').value = currentRole.name;
            document.getElementById('role-guard-name').value = currentRole.guard_name;
            renderPermissionsCheckboxList();
            openModal('role-modal');
        }

        function closeRoleModal() {
            closeModal('role-modal');
            currentRole = null;
        }

        async function submitRoleForm(event) {
            event.preventDefault();
            
            const roleId = document.getElementById('role-id').value;
            const name = document.getElementById('role-name').value.trim();
            const guardName = document.getElementById('role-guard-name').value.trim() || 'web';
            
            const selectedPermissions = Array.from(document.querySelectorAll('#role-permissions-list input[type="checkbox"]:checked'))
                .map(cb => cb.value);

            const data = {
                name,
                guard_name: guardName,
                permissions: selectedPermissions
            };

            try {
                const url = roleId ? `${ROLES_API}/${roleId}` : ROLES_API;
                const method = roleId ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Erreur lors de la sauvegarde');
                }

                showToast(result.message, 'success');
                closeRoleModal();
                await loadRoles();
            } catch (error) {
                console.error('Error saving role:', error);
                showToast(error.message || 'Erreur lors de la sauvegarde du rôle', 'danger');
            }
        }

        // Permission Modal Functions
        function showCreatePermissionModal() {
            currentPermission = null;
            document.getElementById('permission-modal-title').textContent = 'Créer une permission';
            document.getElementById('permission-submit-btn').textContent = 'Créer';
            document.getElementById('permission-form').reset();
            document.getElementById('permission-id').value = '';
            document.getElementById('permission-guard-name').value = 'web';
            openModal('permission-modal');
        }

        async function showEditPermissionModal(permissionId) {
            currentPermission = permissions.find(p => p.id === permissionId);
            if (!currentPermission) return;

            document.getElementById('permission-modal-title').textContent = 'Modifier la permission';
            document.getElementById('permission-submit-btn').textContent = 'Modifier';
            document.getElementById('permission-id').value = currentPermission.id;
            document.getElementById('permission-name').value = currentPermission.name;
            document.getElementById('permission-guard-name').value = currentPermission.guard_name;
            openModal('permission-modal');
        }

        function closePermissionModal() {
            closeModal('permission-modal');
            currentPermission = null;
        }

        async function submitPermissionForm(event) {
            event.preventDefault();
            
            const permissionId = document.getElementById('permission-id').value;
            const name = document.getElementById('permission-name').value.trim();
            const guardName = document.getElementById('permission-guard-name').value.trim() || 'web';

            const data = {
                name,
                guard_name: guardName
            };

            try {
                const url = permissionId ? `${PERMISSIONS_API}/${permissionId}` : PERMISSIONS_API;
                const method = permissionId ? 'PUT' : 'POST';
                
                const response = await fetch(url, {
                    method,
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Erreur lors de la sauvegarde');
                }

                showToast(result.message, 'success');
                closePermissionModal();
                await loadPermissions();
                await loadRoles(); // Refresh roles to update permission counts
            } catch (error) {
                console.error('Error saving permission:', error);
                showToast(error.message || 'Erreur lors de la sauvegarde de la permission', 'danger');
            }
        }

        // Delete Functions
        function confirmDeleteRole(roleId, roleName) {
            document.getElementById('delete-message').textContent = `Êtes-vous sûr de vouloir supprimer le rôle "${roleName}" ?`;
            document.getElementById('confirm-delete-btn').onclick = () => deleteRole(roleId);
            openModal('delete-modal');
        }

        function confirmDeletePermission(permissionId, permissionName) {
            document.getElementById('delete-message').textContent = `Êtes-vous sûr de vouloir supprimer la permission "${permissionName}" ?`;
            document.getElementById('confirm-delete-btn').onclick = () => deletePermission(permissionId);
            openModal('delete-modal');
        }

        function closeDeleteModal() {
            closeModal('delete-modal');
        }

        async function deleteRole(roleId) {
            try {
                const response = await fetch(`${ROLES_API}/${roleId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Erreur lors de la suppression');
                }

                showToast(result.message, 'success');
                closeDeleteModal();
                await loadRoles();
            } catch (error) {
                console.error('Error deleting role:', error);
                showToast(error.message || 'Erreur lors de la suppression du rôle', 'danger');
            }
        }

        async function deletePermission(permissionId) {
            try {
                const response = await fetch(`${PERMISSIONS_API}/${permissionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    }
                });

                const result = await response.json();

                if (!response.ok) {
                    throw new Error(result.message || 'Erreur lors de la suppression');
                }

                showToast(result.message, 'success');
                closeDeleteModal();
                await loadPermissions();
                await loadRoles(); // Refresh roles to update permission counts
            } catch (error) {
                console.error('Error deleting permission:', error);
                showToast(error.message || 'Erreur lors de la suppression de la permission', 'danger');
            }
        }

        // Search Functions
        document.getElementById('user-search').addEventListener('input', (e) => {
            displayUsers(e.target.value);
        });

        document.getElementById('role-search').addEventListener('input', (e) => {
            displayRoles(e.target.value);
        });

        document.getElementById('permission-search').addEventListener('input', (e) => {
            displayPermissions(e.target.value);
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', async () => {
            await Promise.all([loadUsers(), loadRoles(), loadPermissions()]);
        });
    </script>
</body>
</html>
