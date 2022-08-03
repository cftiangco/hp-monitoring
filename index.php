<?php 
  require_once(dirname(__FILE__) . '/models/Survey.php');
  $survey = new Survey();
?>

<?php include './partials/header.php'; ?> 
  <section>
    <div class="grid grid-cols-1 gap-1 md:grid-cols-4 md:gap-4">
      <div class="flex flex-col gap-y-3 h-50 w-full bg-white shadow rounded p-3 border-t-8 border-green-600">
          <h1 class="font-semibold text-gray-600">No. of Surveys</h1>
          <div class="flex gap-x-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm2 10a1 1 0 10-2 0v3a1 1 0 102 0v-3zm2-3a1 1 0 011 1v5a1 1 0 11-2 0v-5a1 1 0 011-1zm4-1a1 1 0 10-2 0v7a1 1 0 102 0V8z" clip-rule="evenodd" />
            </svg>
            <p class="text-yellow-500"><?= $survey->total() ?></p>
          </div>
      </div>
    </div>
  </section>
<?php include './partials/footer.php'; ?> 

