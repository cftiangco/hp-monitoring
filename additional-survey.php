<?php include './partials/header.php'; ?>

<div x-data="{
    isModalChildrenOpen: false,
    addChildren() {
        this.isModalChildrenOpen = true
    }
}">
    <section>
        <div class="h-12 w-full bg-green-600 text-white shadow rounded flex justify-between items-center">
            <h4 class="mx-5 font-semibold text-xl">Survey Form - Part 2</h4>
        </div>
    </section>

    <section class="mt-5">
        <div class="h-fit w-full bg-white shadow py-5">

            <div class="flex justify-between items-center w-full border-b pb-2">
                <h4 class="mx-5 text-md font-sm-bold md:text-xl">Mga Anak</h4>
                <div class="flex justify-end mx-5 text-sm">
                    <button type="submit" @click="addChildren" class="bg-green-600 text-white py-1 px-3 rounded flex items-center gap-x-1 hover:bg-green-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z" />
                        </svg>
                        <span>Add</span>
                    </button>
                </div>
            </div>

            <div class="mx-5 w-full mt-3">
                <table class="table-auto w-full text-start">
                    <thead class="text-left">
                        <tr>
                            <th>Pangalan</th>
                            <th>Kapanganakan</th>
                            <th>Edad</th>
                            <th>Nag-aaral</th>
                            <th>Trabaho</th>
                            <th>Buwanang Sahod</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Crimson Tiangco</td>
                            <td>05/24/1991</td>
                            <td>31</td>
                            <td>Yes</td>
                            <td>IT</td>
                            <td>32,000</td>
                            <td class="flex gap-x-1">
                                <button type="button"  class="bg-red-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M11 6a3 3 0 11-6 0 3 3 0 016 0zM14 17a6 6 0 00-12 0h12zM13 8a1 1 0 100 2h4a1 1 0 100-2h-4z" />
                                    </svg>
                                    <span>Delete</span>
                                </button>
                                <button type="button" class="bg-yellow-500 text-sm text-white px-2 py-1 rounded hover:bg-red-400 flex items-center gap-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    <span>Edit</span>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

    </section>

    <section x-show="isModalChildrenOpen" x-cloak>
        <div class="h-full w-full bg-gray-600 top-0 left-0 right-0 bg-opacity-75 absolute flex flex-row justify-center items-center z-50">
            <div class="bg-white rounded shadow w-auto">
                <div class="border-b p-3 flex justify-between items-center bg-green-600 text-white font-semibold">
                    <h4>Add Children</h4>
                    <svg xmlns="http://www.w3.org/2000/svg" @click="isModalChildrenOpen = false" class="h-6 w-6 cursor-pointer" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
                <div class="p-3 max-full">
                    <form action="">

                    </form>
                </div>
            </div>
        </div>
    </section>

</div>
<?php include './partials/footer.php'; ?>