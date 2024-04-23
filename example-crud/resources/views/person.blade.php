<h1>Person List</h1>
<form action="">
<input type="checkbox" name="selectAll" id="selectAll" onchange="toggleSelectAll()">Select All
<button onclick="deleteAll()" id="deleteAllBtn" disabled>Delete All</button>
</form>
<br>
<table>
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($persons as $person)
            <tr>
                <td>
                    <input type="checkbox" class="delete-checkbox" data-person-id="{{ $person->id }}">
                </td>
                <td>{{ $person->name }}</td>
                <td>{{ $person->email }}</td>
                <td>
                    <form action="{{ route('person.destroy', $person->id) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="button" data-person-id="{{ $person->id }}" onclick="confirmDelete(this)" class="delete-btn">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function confirmDelete(element) {
        const personId = element.getAttribute('data-person-id');
        const checkbox = document.querySelector(`.delete-checkbox[data-person-id="${personId}"]`);

        if (checkbox.checked) {
            if (confirm('Are you sure?')) {
                element.closest('form').submit();
            }
        } else {
            alert('Please select the record before attempting to delete.');
        }
    }

    function toggleSelectAll() {
        const selectAllCheckbox = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.delete-checkbox');
        const deleteAllBtn = document.getElementById('deleteAllBtn');

        checkboxes.forEach(checkbox => {
            checkbox.checked = selectAllCheckbox.checked;
        });

        deleteAllBtn.disabled = !selectAllCheckbox.checked;
    }

    
    function deleteAll() {
        if (confirm('Are you sure you want to delete all selected items?')) {
            const forms = document.querySelectorAll('.delete-form');

            // Array to hold all fetch promises
            const fetchPromises = [];

            // Iterate over each form and create a fetch request
            forms.forEach(form => {
                const formData = new FormData(form); // Create FormData object from form
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Failed to delete item');
                    }
                })
                .catch(error => {
                    console.error(error);
                });
            });

            // After all fetch requests are complete, reload the page
            Promise.all(fetchPromises).then(() => {
                window.location.reload();
            });
        }
    }

    // Add event listener to run toggleSelectAll() initially
    document.addEventListener('DOMContentLoaded', function() {
        toggleSelectAll();
    });
</script>

