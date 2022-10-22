
@section('title', 'Manage Departments')
<div class="card mt-5 w-75 mx-auto shadow-lg">
    <div class="card-header bg-primary">
        <i class="fas fa-arrow-alt-circle-down mr-2"></i>Manage Departments
    </div>
    <div class="card-body">
        <a  class="btn btn-outline-primary rounded-pill float-right mb-2">
            <i class="fas fa-plus-circle mr-2"></i>Create Level</a>
        <table class="table table-striped table-hover table-responsive-lg">
            <thead>
            <tr>
                <th>S/N</th>
                <th>Level Name</th>
                <th>Section</th>
                <th>Class(es)</th>
                <th class="text-center">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Form One</td>
                <td>Grammar</td>
                <td>Form 1A</td>
                <td class="text-center">
                    <span><a class="btn btn-xs btn-outline-primary" ><i class="fas fa-info-circle mr-1"></i>View</a></span>
                    <span><a class="btn btn-xs btn-primary" ><i class="fas fa-edit mr-1"></i>Edit</a></span>
                    <span><a class="btn btn-xs btn-danger " ><i class="fas fa-trash mr-1"></i>Delete</a></span>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
