<template>
    <div class="relative shadow">
        <div class="float-right group">
            <div class="p-4 group-hover:bg-gray-800 group-hover:text-white cursor-pointer">
                <i class="fas fa-filter text-sm text-center"></i>
            </div>

            <div class="absolute bg-white right-0 hidden group-hover:block w-4/6 p-4">
                Elenco filtri:

                <date-picker i18n='EN'></date-picker>

                <button class="bg-gray-800 text-white py-2 px-6">Applica</button>
            </div>
        </div>

    </div>

</template>

<script>
export default {};
</script>