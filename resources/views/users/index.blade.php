<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Gestion des Utilisateurs - Laravel Starter</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .user-card {
            transition: all 0.2s ease;
            cursor: pointer;
        }
        .user-card:hover {
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .search-box {
            margin-bottom: 1rem;
        }
        .role-badge {
            margin: 2px;
            display: inline-block;
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0"></path>
                                    <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                    <path d="M21 21v-2a4 4 0 0 0 -3 -3.85"></path>
                                </svg>
                                Gestion des Utilisateurs
                            </h2>
                            <div class="text-secondary mt-1">
                                Gérer les utilisateurs de l'application
                            </div>
                        </div>
                        <div class="col-auto ms-auto">
                            <button class="btn btn-primary" onclick="showCreateUserModal()">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Créer un utilisateur
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Page body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row row-deck row-cards">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Utilisateurs</h3>
                                    <div class="ms-auto d-flex align-items-center gap-2">
                                        <select class="form-select form-select-sm" id="per-page-select" style="width: auto;">
                                            <option value="10">10 par page</option>
                                            <option value="25">25 par page</option>
                                            <option value="50">50 par page</option>
                                            <option value="100">100 par page</option>
                                        </select>
                                        <span class="badge bg-blue-lt" id="user-count">0</span>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="search-box">
                                        <input type="text" class="form-control" id="user-search" placeholder="Rechercher un utilisateur par nom ou email...">
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-vcenter card-table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nom</th>
                                                    <th>Email</th>
                                                    <th>Rôles</th>
                                                    <th>Date de création</th>
                                                    <th class="w-1">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="users-container">
                                                <tr>
                                                    <td colspan="5" class="text-center py-4">
                                                        <div class="spinner-border spinner-border-sm me-2" role="status"></div>
                                                        Chargement des utilisateurs...
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div id="pagination-container" class="d-flex justify-content-between align-items-center mt-3">
                                        <div id="pagination-info" class="text-muted"></div>
                                        <nav id="pagination-nav" aria-label="Page navigation"></nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create/Edit User Modal -->
    <div class="modal" id="user-modal" tabindex="-1" role="dialog" style="display: none;">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="user-modal-title">Créer un utilisateur</h5>
                    <button type="button" class="btn-close" onclick="closeUserModal()" aria-label="Close"></button>
                </div>
                <form id="user-form" onsubmit="submitUserForm(event)">
                    <div class="modal-body">
                        <input type="hidden" id="user-id">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Nom</label>
                                    <input type="text" class="form-control" id="user-name" required placeholder="Jean Dupont">
                                    <div class="invalid-feedback" id="user-name-error"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control" id="user-email" required placeholder="jean.dupont@example.com">
                                    <div class="invalid-feedback" id="user-email-error"></div>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" id="user-password-label">Mot de passe</label>
                            <input type="password" class="form-control" id="user-password" placeholder="Minimum 8 caractères">
                            <small class="form-hint" id="password-hint">Laissez vide pour conserver le mot de passe actuel</small>
                            <div class="invalid-feedback" id="user-password-error"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Rôles associés</label>
                            <div id="user-roles-list" class="border rounded p-3" style="max-height: 200px; overflow-y: auto;">
                                <div class="text-center text-muted">Chargement des rôles...</div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link link-secondary" onclick="closeUserModal()">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="user-submit-btn">Créer</button>
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
        let users = [];
        let roles = [];
        let currentUser = null;
        let currentPage = 1;
        let perPage = 10;
        let searchQuery = '';
        let searchTimeout = null;

        // CSRF Token
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // API Base URLs
        const USERS_API = '/users/api';
        const ROLES_API = '/permissions/api/roles';

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

        function formatDate(dateString) {
            if (!dateString) return 'N/A';
            const date = new Date(dateString);
            return date.toLocaleDateString('fr-FR', { 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        // Load Data Functions
        async function loadUsers(page = 1) {
            try {
                currentPage = page;
                let url = `${USERS_API}?per_page=${perPage}&page=${page}`;
                
                // Use search endpoint if there's a search query
                if (searchQuery) {
                    url = `${USERS_API}/search?q=${encodeURIComponent(searchQuery)}&per_page=${perPage}&page=${page}`;
                }

                const response = await fetch(url);
                const data = await response.json();
                users = data.users;
                displayUsers();
                displayPagination(data.pagination);
                updateUserCount(data.pagination);
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
            } catch (error) {
                console.error('Error loading roles:', error);
                showToast('Erreur lors du chargement des rôles', 'danger');
            }
        }

        // Display Functions
        function displayUsers() {
            const container = document.getElementById('users-container');

            if (users.length === 0) {
                container.innerHTML = '<tr><td colspan="5" class="text-center text-muted py-4">Aucun utilisateur trouvé</td></tr>';
                return;
            }

            container.innerHTML = users.map(user => `
                <tr class="user-card" onclick="showEditUserModal('${user.id}')">
                    <td>
                        <div class="d-flex align-items-center">
                            <span class="avatar avatar-sm me-2">${escapeHtml(user.name.charAt(0).toUpperCase())}</span>
                            ${escapeHtml(user.name)}
                        </div>
                    </td>
                    <td>${escapeHtml(user.email)}</td>
                    <td>
                        ${user.roles && user.roles.length > 0 
                            ? user.roles.map(r => `<span class="badge bg-blue-lt role-badge">${escapeHtml(r.name)}</span>`).join('') 
                            : '<span class="text-muted">Aucun rôle</span>'
                        }
                    </td>
                    <td class="text-secondary">${formatDate(user.created_at)}</td>
                    <td>
                        <button class="btn btn-sm btn-icon btn-ghost-danger" onclick="event.stopPropagation(); confirmDeleteUser('${user.id}', '${escapeHtml(user.name)}')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M4 7l16 0"></path>
                                <path d="M10 11l0 6"></path>
                                <path d="M14 11l0 6"></path>
                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"></path>
                                <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
            `).join('');
        }

        function updateUserCount(pagination) {
            const total = pagination.total;
            document.getElementById('user-count').textContent = `${total} utilisateur${total !== 1 ? 's' : ''}`;
        }

        function displayPagination(pagination) {
            const infoContainer = document.getElementById('pagination-info');
            const navContainer = document.getElementById('pagination-nav');

            // Update info text
            if (pagination.total > 0) {
                infoContainer.textContent = `Affichage de ${pagination.from} à ${pagination.to} sur ${pagination.total} résultat${pagination.total !== 1 ? 's' : ''}`;
            } else {
                infoContainer.textContent = '';
            }

            // Generate pagination buttons
            if (pagination.last_page <= 1) {
                navContainer.innerHTML = '';
                return;
            }

            let paginationHTML = '<ul class="pagination m-0">';

            // Previous button
            paginationHTML += `
                <li class="page-item ${pagination.current_page === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="event.preventDefault(); ${pagination.current_page > 1 ? `loadUsers(${pagination.current_page - 1})` : 'return false'}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M15 6l-6 6l6 6"></path>
                        </svg>
                        Précédent
                    </a>
                </li>
            `;

            // Page numbers
            const maxPages = 7;
            let startPage = Math.max(1, pagination.current_page - Math.floor(maxPages / 2));
            let endPage = Math.min(pagination.last_page, startPage + maxPages - 1);

            if (endPage - startPage < maxPages - 1) {
                startPage = Math.max(1, endPage - maxPages + 1);
            }

            if (startPage > 1) {
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="event.preventDefault(); loadUsers(1)">1</a>
                    </li>
                `;
                if (startPage > 2) {
                    paginationHTML += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
            }

            for (let i = startPage; i <= endPage; i++) {
                paginationHTML += `
                    <li class="page-item ${i === pagination.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="event.preventDefault(); loadUsers(${i})">${i}</a>
                    </li>
                `;
            }

            if (endPage < pagination.last_page) {
                if (endPage < pagination.last_page - 1) {
                    paginationHTML += '<li class="page-item disabled"><span class="page-link">...</span></li>';
                }
                paginationHTML += `
                    <li class="page-item">
                        <a class="page-link" href="#" onclick="event.preventDefault(); loadUsers(${pagination.last_page})">${pagination.last_page}</a>
                    </li>
                `;
            }

            // Next button
            paginationHTML += `
                <li class="page-item ${pagination.current_page === pagination.last_page ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="event.preventDefault(); ${pagination.current_page < pagination.last_page ? `loadUsers(${pagination.current_page + 1})` : 'return false'}">
                        Suivant
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M9 6l6 6l-6 6"></path>
                        </svg>
                    </a>
                </li>
            `;

            paginationHTML += '</ul>';
            navContainer.innerHTML = paginationHTML;
        }

        function renderRolesCheckboxList() {
            const container = document.getElementById('user-roles-list');
            if (roles.length === 0) {
                container.innerHTML = '<div class="text-center text-muted">Aucun rôle disponible</div>';
                return;
            }

            const currentRoles = currentUser && currentUser.roles ? currentUser.roles.map(r => r.name) : [];
            container.innerHTML = roles.map(role => `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="${escapeHtml(role.name)}" id="role-${role.id}" ${currentRoles.includes(role.name) ? 'checked' : ''}>
                    <label class="form-check-label" for="role-${role.id}">
                        ${escapeHtml(role.name)}
                    </label>
                </div>
            `).join('');
        }

        // User Modal Functions
        function showCreateUserModal() {
            currentUser = null;
            document.getElementById('user-modal-title').textContent = 'Créer un utilisateur';
            document.getElementById('user-submit-btn').textContent = 'Créer';
            document.getElementById('user-form').reset();
            document.getElementById('user-id').value = '';
            document.getElementById('user-password').required = true;
            document.getElementById('user-password-label').classList.add('required');
            document.getElementById('password-hint').style.display = 'none';
            renderRolesCheckboxList();
            openModal('user-modal');
        }

        async function showEditUserModal(userId) {
            currentUser = users.find(u => u.id === userId);
            if (!currentUser) return;

            document.getElementById('user-modal-title').textContent = 'Modifier l\'utilisateur';
            document.getElementById('user-submit-btn').textContent = 'Modifier';
            document.getElementById('user-id').value = currentUser.id;
            document.getElementById('user-name').value = currentUser.name;
            document.getElementById('user-email').value = currentUser.email;
            document.getElementById('user-password').value = '';
            document.getElementById('user-password').required = false;
            document.getElementById('user-password-label').classList.remove('required');
            document.getElementById('password-hint').style.display = 'block';
            renderRolesCheckboxList();
            openModal('user-modal');
        }

        function closeUserModal() {
            closeModal('user-modal');
            currentUser = null;
        }

        async function submitUserForm(event) {
            event.preventDefault();
            
            const userId = document.getElementById('user-id').value;
            const name = document.getElementById('user-name').value.trim();
            const email = document.getElementById('user-email').value.trim();
            const password = document.getElementById('user-password').value;
            
            const selectedRoles = Array.from(document.querySelectorAll('#user-roles-list input[type="checkbox"]:checked'))
                .map(cb => cb.value);

            const data = {
                name,
                email,
                roles: selectedRoles
            };

            if (password) {
                data.password = password;
            }

            try {
                const url = userId ? `${USERS_API}/${userId}` : USERS_API;
                const method = userId ? 'PUT' : 'POST';
                
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
                closeUserModal();
                await loadUsers();
            } catch (error) {
                console.error('Error saving user:', error);
                showToast(error.message || 'Erreur lors de la sauvegarde de l\'utilisateur', 'danger');
            }
        }

        // Delete Functions
        function confirmDeleteUser(userId, userName) {
            document.getElementById('delete-message').textContent = `Êtes-vous sûr de vouloir supprimer l'utilisateur "${userName}" ?`;
            document.getElementById('confirm-delete-btn').onclick = () => deleteUser(userId);
            openModal('delete-modal');
        }

        function closeDeleteModal() {
            closeModal('delete-modal');
        }

        async function deleteUser(userId) {
            try {
                const response = await fetch(`${USERS_API}/${userId}`, {
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
                await loadUsers();
            } catch (error) {
                console.error('Error deleting user:', error);
                showToast(error.message || 'Erreur lors de la suppression de l\'utilisateur', 'danger');
            }
        }

        // Search Functions
        document.getElementById('user-search').addEventListener('input', (e) => {
            searchQuery = e.target.value.trim();
            
            // Clear existing timeout
            if (searchTimeout) {
                clearTimeout(searchTimeout);
            }
            
            // Debounce search - wait 300ms after user stops typing
            searchTimeout = setTimeout(() => {
                currentPage = 1; // Reset to first page on search
                loadUsers(1);
            }, 300);
        });

        // Per page change handler
        document.getElementById('per-page-select').addEventListener('change', (e) => {
            perPage = parseInt(e.target.value);
            currentPage = 1; // Reset to first page on per-page change
            loadUsers(1);
        });

        // Initialize on page load
        document.addEventListener('DOMContentLoaded', async () => {
            await Promise.all([loadUsers(), loadRoles()]);
        });
    </script>
</body>
</html>
