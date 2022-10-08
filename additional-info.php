<?php
session_start();
require_once(dirname(__FILE__) . '/func/helpers.php');
require_once(dirname(__FILE__) . '/models/Survey.php');
require_once(dirname(__FILE__) . '/models/Log.php');

$required = true;

$survey = new Survey();
$log = new Log();

$data = "";

if (isset($_GET['user_id']) && $_GET['user_id']) {
    $data = $survey->getSurveyByHashUserId($_GET['user_id']);
    if (isset($_POST['update'])) {
        $values = [
            'toilet_type' => $_POST['toilet_type'],
            'dwelling_unit' => $_POST['dwelling_unit'],
            'water_source' => $_POST['water_source'],
            'vagetable_garden' => $_POST['vagetable_garden'],
            'using_iodized_salt' => $_POST['using_iodized_salt'],
            'has_animals' => $_POST['has_animals'],
            'type_of_animals' => $_POST['type_of_animals'],
            'using_fortified_foods' => $_POST['using_fortified_foods'],
            'id' => $_POST['id']
        ];
        $result = $survey->updateAdditionalInfo($values);

        if ($result) {
            $log->addLog($_SESSION['user_id'],'Updated his/her additional information');
            header('Location: form.php?active=myapplication&id='.md5($_POST['id']));
        }
    }
}
?>

<?php include './partials/header.php'; ?>

<section>
    <div class="h-12 w-full bg-yellow-600 text-white shadow rounded flex justify-between items-center">
        <h4 class="mx-5 font-semibold text-xl">Edit Additional Information</h4>
    </div>
</section>

<section x-data="{
    hasAnimals:'<?= $data->has_animals ?>',
    vagetableGarden:'<?= $data->vagetable_garden ?>',
    usingIodized:'<?= $data->using_iodized_salt ?>',
    usingFortifiedFoods:'<?= $data->using_fortified_foods ?>',
}">
    <form action="<?= $_SERVER['PHP_SELF'] ?>?active=myapplication&user_id=<?= $_GET['user_id'] ?>" method="POST" onsubmit="return confirm('Are you sure you want to Submit?');">
        <div class="p-3">
            <input type="hidden" name="id" value="<?= $data->id ?>">
            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="toilet_type">Toilet Type</label>
                    <select name="toilet_type" id="toilet_type" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                        <?php foreach ($toiletTypes as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= $data->toilet_type == $value ? 'selected':''?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="dwelling_unit">Dwelling Unit</label>
                    <select name="dwelling_unit" id="dwelling_unit" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                        <?php foreach ($dwellingUnits as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= $data->dwelling_unit == $value ? 'selected':''?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="water_source">Water Source</label>
                    <select name="water_source" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white" <?= $required ? 'required' : '' ?>>
                        <?php foreach ($waterSources as $key => $value) : ?>
                            <option value="<?= $value ?>" <?= $data->water_source == $value ? 'selected':''?>><?= $value ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

            </div>

            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="vagetable_garden">Mayroong Vegetable Garden</label>
                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                        <div>
                            <label for="vagetable_garden_y">Yes</label>
                            <input type="radio" name="vagetable_garden" id="vagetable_garden_y" value="y" x-model="vagetableGarden">
                        </div>
                        <div>
                            <label for="vagetable_garden_n">No</label>
                            <input type="radio" name="vagetable_garden" id="vagetable_garden_n" value="n" x-model="vagetableGarden">
                        </div>
                    </div>
                </div>

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="using_iodized_salt">Gumagamit ng IODIZED SALT</label>
                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                        <div>
                            <label for="using_iodized_salt_y">Yes</label>
                            <input type="radio" name="using_iodized_salt" id="using_iodized_salt_y" x-model="usingIodized" value="y">
                        </div>
                        <div>
                            <label for="using_iodized_salt_n">No</label>
                            <input type="radio" name="using_iodized_salt" id="using_iodized_salt_n" x-model="usingIodized" value="n">
                        </div>
                    </div>
                </div>

            </div>

            <div class="grid grid-cols-1 gap-1 md:grid-cols-3 md:gap-3 md:space-x-5">

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="has_animals">Nag-aalaga ng Hayop</label>
                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                        <div>
                            <label for="has_animals_y">Yes</label>
                            <input type="radio" name="has_animals" x-model="hasAnimals" id="has_animals_y" value="y">
                        </div>
                        <div>
                            <label for="has_animals_n">No</label>
                            <input type="radio" name="has_animals" x-model="hasAnimals" id="has_animals_n" value="n">
                        </div>
                    </div>
                </div>


                <div class="flex flex-col gap-y-2 mb-3" x-show="hasAnimals === 'y'">
                    <label for="type_of_animals">Ano-anong uri ng Hayop</label>
                    <input type="text" value="<?= $data->type_of_animals ?>" name="type_of_animals" id="type_of_animals" class="bg-gray-50 outline-none border px-3 py-2 rounded w-auto hover:border-2 hover:border-blue-300 hover:bg-white">
                </div>

                <div class="flex flex-col gap-y-2 mb-3">
                    <label for="using_fortified_foods" class="text-sm">Gumagamit ng FORTIFIED FOODS with SPShe</label>
                    <div class="flex gap-x-3 py-2 px-2 shadow rounded">
                        <div>
                            <label for="using_fortified_foods_y">Yes</label>
                            <input type="radio" name="using_fortified_foods" id="using_fortified_foods_y" value="y" x-model="usingFortifiedFoods">
                        </div>
                        <div>
                            <label for="using_fortified_foods_n">No</label>
                            <input type="radio" name="using_fortified_foods" id="using_fortified_foods_n" value="n" x-model="usingFortifiedFoods">
                        </div>
                    </div>
                </div>

            </div>

            <div class="fixed bottom-0 left-0 right-1 w-screen z-50 p-3 bg-black bg-opacity-25">
                <button type="submit" name="update" class="bg-yellow-600 text-white py-2 px-5 rounded flex items-center gap-x-1 hover:bg-yellow-400 float-right mr-5 md:mr-10">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    <span>Update Survey</span>
                </button>
            </div>

        </div>
    </form>
</section>

<?php include './partials/footer.php'; ?>