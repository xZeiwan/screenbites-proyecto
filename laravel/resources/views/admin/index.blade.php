<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel - Screenbites</title>
    <style>
        body { background: #050505; color: white; font-family: sans-serif; padding: 50px; }
        .container { max-width: 1100px; margin: 0 auto; }
        h1 { font-family: 'Arial Black', sans-serif; border-left: 5px solid #ffd000; padding-left: 15px; margin-bottom: 40px; }
        table { width: 100%; border-collapse: collapse; background: #111; border-radius: 8px; overflow: hidden; margin-bottom: 50px; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid #222; }
        th { background: #ffd000; color: black; text-transform: uppercase; font-size: 12px; }
        .badge { padding: 4px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; text-transform: uppercase; }
        .badge-user { background: #444; }
        .badge-vip { background: #ffd000; color: black; }
        .badge-admin { background: #ff4444; }
        select { background: #222; color: white; border: 1px solid #333; padding: 5px; border-radius: 4px; }
        .btn { padding: 8px 15px; border: none; border-radius: 4px; cursor: pointer; font-weight: bold; text-transform: uppercase; font-size: 11px; }
        .btn-delete { background: transparent; color: #ff4444; border: 1px solid #ff4444; }
        .btn-delete:hover { background: #ff4444; color: white; }
        .btn-save { background: #ffd000; color: black; margin-left: 5px; }
    </style>
</head>
<body>
    <div class="container">
        <a href="/" style="color: #888; text-decoration: none;">← Back to Home</a>
        <h1>User Management</h1>

        @if(session('status'))
            <div style="background: #4ade80; color: black; padding: 15px; border-radius: 8px; margin-bottom: 20px;">{{ session('status') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Current Role</th>
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
                        <form action="{{ route('admin.updateRole', $user) }}" method="POST" style="display:inline;">
                            @csrf @method('PATCH')
                            <select name="role">
                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                <option value="vip" {{ $user->role == 'vip' ? 'selected' : '' }}>VIP</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                            </select>
                            <button type="submit" class="btn btn-save">Update</button>
                        </form>
                        <form action="{{ route('admin.deleteUser', $user) }}" method="POST" style="display:inline; margin-left: 10px;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete" onclick="return confirm('Are you sure?')">Ban</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <h1>Review Moderation</h1>
        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Comment</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($reviews as $review)
                <tr>
                    <td style="color: #ffd000;">{{ $review->author }}</td>
                    <td style="font-size: 13px; color: #ccc;">"{{ $review->content }}"</td>
                    <td>
                        <form action="{{ route('admin.deleteReview', $review->id) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-delete">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>