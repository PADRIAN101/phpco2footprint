<?php include $this->resolve("partials/_header.php"); ?>

<section class="max-w-2xl mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">
    <form method="POST" class="grid grid-cols-1 gap-6">
        <?php include $this->resolve("partials/_csrf.php"); ?>

        <label class="block">
            <span class="text-gray-700">Date</span>
            <input value="<?php echo e($transaction['formatted_date']); ?>" name="date" type="date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <?php if (array_key_exists('date', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo $errors['date'][0]; ?>
                </div>
            <?php endif; ?>
        </label>
        <label class="block">
            <span class="text-gray-700">Category</span>
            <select value="<?php echo e($transaction['category']); ?>" name="category" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <option value="Electricity">Electricity in kWh </option>
            <option value="Public Transportation">Public Transportation in km </option>
            <option value="Fuel">Fuel in liters </option>
            <option value="Flights">Flights in km </option>
            </select>
            <?php if (array_key_exists('category', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo $errors['category'][0]; ?>
                </div>
            <?php endif; ?>
        </label>
        <label class="block">
            <span class="text-gray-700">Usage</span>
            <input value="<?php echo e($transaction['emission']); ?>" name="emission" type="number" step="0.01" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />
            <?php if (array_key_exists('emission', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo $errors['emission'][0]; ?>
                </div>
            <?php endif; ?>
        </label>
        <label class="block">
            <span class="text-gray-700">Description</span>
            <input value="<?php echo e($transaction['description']); ?>" name="description" type="text" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" />

            <?php if (array_key_exists('description', $errors)) : ?>
                <div class="bg-gray-100 mt-2 p-2 text-red-500">
                    <?php echo $errors['description'][0]; ?>
                </div>
            <?php endif; ?>
        </label>
        <button type="submit" class="block w-full py-2 bg-green-600 text-white rounded">
            Submit
        </button>
    </form>
</section>

<?php include $this->resolve("partials/_footer.php"); ?>