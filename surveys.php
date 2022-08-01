<?php include './partials/header.php'; ?>
<section>
  <div class="h-16 w-full bg-white shadow rounded flex justify-between items-center">
    <h4 class="mx-5 font-semibold">Records</h4>
    <div class="flex justify-end mx-5 text-sm">
      <a href="add-survey.php?active=surveys" class="bg-green-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-green-400">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
        </svg>
        <span>Add Survey</span>
      </a>
    </div>
  </div>
</section>

<section class="mt-5">
  <div class="w-full bg-white p-4 rounded shadow">
    <table id="table_id" class="display nowrap" style="width:100%">
      <thead>
        <tr>
          <th>Last Name</th>
          <th>First Name</th>
          <th>Username</th>
          <th>Role</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody id="table-body">
        
      </tbody>
    </table>
  </div>
</section>
<?php include './partials/footer.php'; ?>