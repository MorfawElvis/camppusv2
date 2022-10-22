@section('title', 'School Settings')
<div class="card mt-5 w-75 mx-auto shadow-lg">
    <div class="card-header">
        <ul class="nav nav-pills" id="custom-pill">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"  data-bs-toggle="pill" data-bs-target="#levels">
                    <i class="fas fa-arrow-alt-circle-down mr-1"></i>Manage Levels</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"  data-bs-toggle="pill" data-bs-target="#classes">
                    <i class="fas fa-arrow-alt-circle-down mr-1"></i>Manage Classes</button>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-pillContent">
            <div class="tab-pane fade show active" role="tabpanel" id="levels">
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
            <div class="tab-pane fade"  role="tabpanel" id="classes">

            </div>
        </div>
    </div>
</div>
