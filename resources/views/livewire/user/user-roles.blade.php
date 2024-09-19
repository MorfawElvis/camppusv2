<div>
    @section('title', 'User Roles')
    <div class="card mx-auto shadow-lg w-50">
        <div class="card-header bg-primary">
            <i class="fas fa-user-tag"></i>
            User Roles
        </div>
        <div class="card-body">
            <form wire:submit.prevent="addRole">
                <div class="justify-content-center">
                    <label for="role_name" class="form-label">Enter text:</label>
                    <div class="d-flex">
                        <input type="text" id="role_name" class="form-control me-2 text-capitalize w-50" placeholder="Enter role name" wire:model="role_name">
                        <button type="submit" class="btn btn-primary">Add Role</button>
                    </div>
                </div>
            </form>
            <div class="mt-2">
                <hr>
                <h4>Existing Roles</h4>
                <div class="row">
                    @php
                        $chunks = $roles->chunk(4);
                    @endphp
                    @foreach($chunks as $chunk)
                        <div class="col">
                            <ol>
                                @foreach($chunk as $role)
                                    <li>{{ $role->name }}</li>
                                @endforeach
                            </ol>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

