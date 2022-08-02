<?php
require_once('./models/Survey.php');
$survey = new Survey();
$surveys = $survey->fetchAll();
?>
<?php include './partials/header.php'; ?>
<div x-data="{
  onDelete(id) {
    if (confirm('Are you sure you want to delete this record?') == true) {
      postData(`api/surveys.php?action=delete&id=${id}`)
          .then((data) => {
              if (data.status === 200) {
                  window.top.location = window.top.location;
                  alert('Record has been successfully delete');
                  return;
              }
          });
    } 
  }  
}">
<section>
  <div class="h-16 w-full bg-white shadow rounded flex justify-between items-center">
    <h4 class="mx-5 font-semibold">Records</h4>
    <div class="flex justify-end mx-5 text-sm">
      <a href="add-survey.php?active=surveys" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <span class="hidden lg:block">Add Survey</span>
      </a>
    </div>
  </div>
</section>

<section class="mt-5">
  <div class="w-full bg-white p-4 rounded shadow">
    <table id="table_id" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>HH No.</th>
          <th>Household Head</th>
          <th>Birthday</th>
          <th>Purok</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="table-body">
        <?php foreach ($surveys as $row) : ?>
          <tr>
            <td><?= $row['hh_no'] ?></td>
            <td><?= $row['household_head'] ?></td>
            <td><?= $row['household_head_birthday'] ?></td>
            <td><?= $row['purok'] ?></td>
            <td class="flex gap-x-1">

              <button type="button" @click="() => onDelete(<?= $row['id'] ?>)" class="bg-red-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z" />
                </svg>
                <span class="hidden lg:block">Delete</span>
              </button>

              <a href="edit-survey.php?active=surveys&id=<?= $row['id'] ?>" class="bg-yellow-500 text-sm text-white px-2 py-1 rounded hover:bg-yellow-400 flex items-center gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
                <span class="hidden lg:block">Edit</span>
              </a>

              <a href="members.php?active=surveys&id=<?= $row['id']?>" class="bg-green-500 text-sm text-white px-2 py-1 rounded hover:bg-green-400 flex items-center gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                  <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                </svg>
                <span class="hidden lg:block">Members</span>
              </a>

              <a href="view.php?active=surveys&id=<?= $row['id']?>" class="bg-gray-500 text-sm text-white px-2 py-1 rounded hover:bg-gray-400 flex items-center gap-x-1">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span class="hidden lg:block">View</span>
              </a>


            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</section>
</div>
<?php include './partials/footer.php'; ?>