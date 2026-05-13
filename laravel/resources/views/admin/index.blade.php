<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Screenbites</title>
    <style>
        body { 
            background: #050505; 
            color: white; 
            font-family: sans-serif; 
            padding: 50px; 
        }

        .container { 
            max-width: 1100px; 
            margin: 0 auto; 
        }

        .back-btn { 
            color: var(--color-blanco); 
            text-decoration: none; 
            display: flex; 
            align-items: center; 
            gap: 8px; 
            font-weight: bold; 
            font-size: 14px; 
            text-transform: uppercase; 
            transition: color 0.3s ease; 

            &:hover { 
                color: var(--color-amarillo); 
            }
        }

        h1 { 
            font-family: 'Arial Black', sans-serif; 
            border-left: 5px solid #ffd000; 
            padding-left: 15px; 
            margin-bottom: 40px; 
        }

        table { 
            width: 100%; 
            border-collapse: collapse; 
            background: #111; 
            border-radius: 8px; 
            overflow: hidden; 
            margin-bottom: 50px; 
            table-layout: fixed; 
        }
        th, td { 
            padding: 15px; 
            text-align: left; 
            border-bottom: 1px solid #222; 
            word-wrap: break-word; 
            vertical-align: middle;
        }
        th { 
            background: #ffd000; 
            color: black; 
            text-transform: uppercase; 
            font-size: 12px; 
        }

        td {
            font-size: 14px;
            color: #eee;
        }

        /* --- Anchos para la tabla de Usuarios (5 columnas) --- */
        .table-users th:nth-child(1) { width: 15%; } 
        .table-users th:nth-child(2) { width: 25%; } 
        .table-users th:nth-child(3) { width: 15%; } 
        .table-users th:nth-child(4) { width: 15%; }
        .table-users th:nth-child(5) { width: 30%; } 

        /* --- Anchos para la tabla de Reseñas (4 columnas) --- */
        .table-reviews th:nth-child(1) { width: 20%; }
        .table-reviews th:nth-child(2) { width: 35%; } 
        .table-reviews th:nth-child(3) { width: 12%; }
        .table-reviews th:nth-child(4) { width: 33%; } 

        .actions-wrapper {
            display: flex;
            align-items: center;
            gap: 15px; 
            flex-wrap: nowrap; 
        }

        .form-update {
            display: flex;
            align-items: center;
            gap: 10px; 
            flex-wrap: nowrap; 
        }

        .badge { 
            padding: 4px 8px; 
            border-radius: 4px; 
            font-size: 11px; 
            font-weight: bold; 
            text-transform: uppercase; 
        }

        .badge-user { 
            background: #444; 
        }

        .badge-vip { 
            background: #ffd000; 
            color: black; 
        }

        .badge-admin { 
            background: #ff4444; 
        }
        
        /* Badges para el Status de las reseñas */
        .badge-pending { 
            background: rgba(255,165,0,0.2); 
            color: orange; 
            border: 1px solid orange; 
        }

        .badge-approved { 
            background: rgba(74,222,128,0.2); 
            color: #4ade80; 
            border: 1px solid #4ade80; 
        }
        
        select { 
            background: #222; 
            color: white; 
            border: 1px solid #333; 
            padding: 5px; 
            border-radius: 4px; 
        }

        .btn { 
            padding: 8px 15px; 
            border: none; 
            border-radius: 4px; 
            cursor: pointer; 
            font-weight: bold; 
            text-transform: uppercase; 
            font-size: 11px; 
        }

        .btn-delete { 
            background: transparent; 
            color: #ff4444; 
            border: 1px solid #ff4444; 
            transition: all 0.3s;
        }

        .btn-delete:hover { 
            background: #ff4444; 
            color: white; 
            transform: scale(1.05); 
        }

        .btn-save { 
            background: #ffd000; 
            color: black; 
            margin-left: 5px; 
            transition: all 0.3s; 
        }

        .btn-save:hover { 
            transform: scale(1.05); 
        }

        /* --- ESTILOS DEL MODAL DE CONFIRMACIÓN --- */
        .custom-modal-overlay {
            position: fixed; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%;
            background: rgba(0, 0, 0, 0.85); 
            backdrop-filter: blur(5px);
            z-index: 10000; 
            display: flex; 
            align-items: center; 
            justify-content: center;
            opacity: 0; 
            visibility: hidden; 
            transition: all 0.3s ease;
        }

        .custom-modal-overlay.active { 
            opacity: 1; 
            visibility: visible; 
        }

        .custom-modal-box {
            background: #0a0a0a; 
            border: 1px solid #333;
            padding: 40px; 
            border-radius: 12px; 
            text-align: center; 
            max-width: 420px; 
            width: 90%;
            box-shadow: 0 25px 50px rgba(0,0,0,0.9); 
            transform: translateY(30px);
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        .custom-modal-overlay.active .custom-modal-box { 
            transform: translateY(0); 
        }

        .custom-modal-box h3 { 
            font-family: 'Arial Black', sans-serif; 
            font-size: 22px; 
            margin-bottom: 10px; 
            color: #ffffff; 
            text-transform: uppercase; 
        }

        .custom-modal-box p { 
            color: #aaa; 
            font-size: 15px; 
        }

        .btn-modal-cancel {
            background: transparent; 
            color: #fff; 
            border: 1px solid #555;
            padding: 10px 20px; 
            border-radius: 6px; 
            cursor: pointer;
            font-weight: bold; 
            transition: all 0.3s; 
            text-transform: uppercase; 
            font-size: 12px;
        }
        .btn-modal-cancel:hover { 
            background: #333; 
        }

        .btn-modal-danger {
            background: #ff4444; 
            color: #fff; 
            border: none;
            padding: 10px 20px; 
            border-radius: 6px; 
            cursor: pointer;
            font-weight: bold; 
            transition: all 0.3s; 
            text-transform: uppercase; 
            font-size: 12px;
        }
        
        .btn-modal-danger:hover { 
            background: #cc0000; 
            transform: scale(1.05); 
        }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
            Back to Home
        </a>
        
        <h1>User Management</h1>
        @if(session('status'))
            <div style="background: #4ade80; color: black; padding: 15px; border-radius: 8px; margin-bottom: 20px;">{{ session('status') }}</div>
        @endif

        <table class="table-users">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
                    <th>Cookies Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><span class="badge badge-{{ $user->role }}">{{ $user->role }}</span></td>
                    
                    <td>
                        @if(is_null($user->cookie_consent))
                            <span class="badge" style="background: #444; color: #aaa;">Pending</span>
                        @elseif($user->cookie_consent === 'accepted')
                            <span class="badge" style="background: rgba(74,222,128,0.2); color: #4ade80; border: 1px solid #4ade80;">Accepted</span>
                        @else
                            <span class="badge" style="background: rgba(255,68,68,0.2); color: #ff4444; border: 1px solid #ff4444;">Rejected</span>
                        @endif
                    </td>
                    <td>
                        <div class="actions-wrapper">
                            <form action="{{ route('admin.updateRole', $user) }}" method="POST">
                                @csrf @method('PATCH')
                                <select name="role">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="vip" {{ $user->role == 'vip' ? 'selected' : '' }}>VIP</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                                <button type="submit" class="btn btn-save">Update</button>
                            </form>
                            
                            <form id="ban-user-{{ $user->id }}" action="{{ route('admin.deleteUser', $user) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-delete" 
                                    onclick="openConfirmModal('Ban User', 'Are you sure you want to ban {{ addslashes($user->name) }}?', 'ban-user-{{ $user->id }}')">
                                    Ban
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h1>Review Moderation</h1>
        <table class="table-reviews">
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Consent</th> <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td style="color: #ffd000; font-weight: bold;">{{ $review->name ?? $review->author ?? 'User' }}</td>
                    <td style="color: #aaa; font-style: italic;">"{{ $review->comment ?? $review->content ?? '' }}"</td>
                    <td>
                        <span class="badge badge-{{ $review->status ?? 'pending' }}">
                            {{ $review->status ?? 'pending' }}
                        </span>
                    </td>
                    <td>
                        <div class="actions-wrapper">
                            <form action="{{ route('admin.updateReviewStatus', $review->id) }}" method="POST">
                                @csrf @method('PATCH')
                                <select name="status">
                                    <option value="pending" {{ ($review->status ?? 'pending') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="approved" {{ ($review->status ?? 'pending') == 'approved' ? 'selected' : '' }}>Approved</option>
                                </select>
                                <button type="submit" class="btn btn-save">Update</button>
                            </form>
                            
                            <form id="delete-review-{{ $review->id }}" action="{{ route('admin.deleteReview', $review->id) }}" method="POST">
                                @csrf @method('DELETE')
                                <button type="button" class="btn btn-delete" 
                                    onclick="openConfirmModal('Delete Review', 'Are you sure you want to delete this review forever?', 'delete-review-{{ $review->id }}')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="color: #ffd000; font-weight: bold;">{{ $review->author }}</td>
                    <td style="color: #aaa; font-style: italic;">"{{ $review->content }}"</td>

                    <td>
                        @if($review->privacy_accepted)
                            <span class="badge" style="background: rgba(74,222,128,0.1); color: #4ade80; border: 1px solid #4ade80; font-size: 9px;">✓ ACCEPTED</span>
                        @else
                            <span class="badge" style="background: rgba(255,68,68,0.1); color: #ff4444; border: 1px solid #ff4444; font-size: 9px;">X ERROR</span>
                        @endif
                    </td>

                    <td>... resto de celdas ...</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="confirm-modal" class="custom-modal-overlay">
        <div class="custom-modal-box">
            <div class="modal-icon" style="margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#ff4444" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                    <line x1="12" y1="9" x2="12" y2="13"></line>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <h3 id="confirm-modal-title">Are you sure?</h3>
            <p id="confirm-modal-message">This action cannot be undone.</p>
            
            <div class="modal-actions" style="display: flex; gap: 15px; justify-content: center; margin-top: 25px;">
                <button type="button" id="cancel-action-btn" class="btn-modal-cancel">Cancel</button>
                <button type="button" id="confirm-action-btn" class="btn-modal-danger">Yes, do it</button>
            </div>
        </div>
    </div>

    <script>
        let formToSubmit = null; 

        function openConfirmModal(title, message, formId) {
            document.getElementById('confirm-modal-title').innerText = title;
            document.getElementById('confirm-modal-message').innerText = message;
            
            // Buscamos el formulario por su ID exacto
            formToSubmit = document.getElementById(formId);
            
            document.getElementById('confirm-modal').classList.add('active');
        }

        document.getElementById('cancel-action-btn').addEventListener('click', () => {
            document.getElementById('confirm-modal').classList.remove('active');
            formToSubmit = null;
        });

        document.getElementById('confirm-action-btn').addEventListener('click', () => {
            if (formToSubmit) {
                document.getElementById('confirm-action-btn').disabled = true;
                document.getElementById('confirm-action-btn').innerText = 'Processing...';
                formToSubmit.submit();
            }
        });
    </script>
</body>
</html>