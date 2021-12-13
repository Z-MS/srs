<table class="border divide-y divide-gray-300" id="facTable">
    <thead>
        <tr>
            <th class="px-6 py-2 text-sm text-gray-500">Name</th>
            <th class="px-6 py-2 text-sm text-gray-500">Code</th>
            <th class="px-6 py-2 text-sm text-gray-500">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($faculties as $faculty)
        <tr class="whitespace no-wrap hover:bg-gray-200" >
            <td class="px-6 py-4">{{ $faculty->name }}</td>
            <td class="px-6 py-4">{{ $faculty->code }}</td>
            <td class="px-6 py-4">
                <a href="{{ '/faculty/'. $faculty->name }}" class="bg-blue-500 text-white p-1.5 rounded">View/Edit</a>
                <button onclick="openDialog(event)" id="{{ $faculty->name }}" class="bg-red-500 text-white p-1.5 ml-2 rounded">Delete</button>
            </td>
            <dialog id="{{ 'confDiag'.$faculty->name }}" data-active="false">
                <form method="POST" id="{{ 'delForm'.$faculty->name }}">
                    @method('DELETE')
                    @csrf
                    <input type="hidden" name="name" value="{{ $faculty->name }}" id="{{ 'hdnname'.$faculty->name }}"/>
                    <input onclick="deleteFac(event)" type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold mb-4 py-2 px-4 rounded" value="Yes" />
                    <input onclick="closeDialog()" type="button" class="bg-green-500 hover:bg-green-700 text-white font-bold mb-4 py-2 px-4 rounded" value="No"/>
                </form>
            </dialog>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    function openDialog(event) {
        let confDialog = document.getElementById(`confDiag${event.target.id}`);
        confDialog.dataset.active = "true";
        confDialog.showModal();
    }

    function getOpenDialog() {
        let dialogs = document.querySelectorAll('dialog');
        let confDialog;
    
        for(let i = 0; i < dialogs.length; i++) {
            if(dialogs[i].dataset.active === "true") {
                confDialog = dialogs[i]
            }
        }

        return confDialog;

    }

    function closeDialog(toSave, diag) {
        if(!toSave) {
            diag = getOpenDialog();
        }

        diag.dataset.active = "false";
        diag.close();
    }

    function deleteFac(event) {
        event.preventDefault();
        let dialog = getOpenDialog();
        let name = dialog.id.slice(8); // Extract the faculty name from the dialog's id
        /*
        each dialog's id is 'confDiag' + faculty name
          each form's id is 'delForm' + faculty name */
        let token;
        try {
            token = document.getElementById(`delForm${name}`).elements.namedItem('_token').value;
        } catch (error) {
            // TEMPORARY(POSSIBLY PERMANENT) FIX, TRY USING YOUR TABLE COMPONENT LATER
            let nearToken = document.getElementById(`hdnname${name}`);
            token = nearToken.previousElementSibling.value;
            /* when the view is reloaded, the forms become empty and the inputs are located outside of it, but are still in the same dialog
            I don't know why */
        }

        fetch(`/faculty/${name}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': token
            }
        }).then((response) => {
            let parentDiv = document.querySelector('#facTable').parentElement;
            response.text().then((text) => {
                parentDiv.innerHTML = text; 
            })
        })

        closeDialog(true, dialog);
    }

</script>