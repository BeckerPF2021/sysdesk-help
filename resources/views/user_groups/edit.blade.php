<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Group</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="mb-4 navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">UserGroup CRUD</a>
        <div class="collapse navbar-collapse">
            <ul class="ml-auto navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('user-groups.index') }}" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('user-groups.create') }}" class="nav-link">Create Group</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Conteúdo -->
    <div class="container">
        <h1>Edit User Group</h1>

        {{-- Exibe erros de validação --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Formulário --}}
        <form action="{{ route('user-groups.update', $userGroup->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Group Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $userGroup->name) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Description (optional)</label>
                <textarea name="description" class="form-control" rows="3">{{ old('description', $userGroup->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('user-groups.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
