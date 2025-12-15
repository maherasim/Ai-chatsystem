<!-- Create Task Modal -->
<div class="modal fade" id="createTaskModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createTaskForm">
                    <div class="mb-3">
                        <label for="projectTitle" class="form-label">Project Title</label>
                        <input type="text" class="form-control" id="projectTitle" placeholder="Enter project title">
                    </div>
                    <div class="mb-3">
                        <label for="projectDesc" class="form-label">Description</label>
                        <textarea class="form-control" id="projectDesc" rows="3" placeholder="Enter description"></textarea>
                    </div>
                    <!-- Add more fields as needed -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" style="background-color: #22c55e; border-color: #22c55e;">Save Project</button>
            </div>
        </div>
    </div>
</div>
