<?php include $this->resolve("partials/_header.php"); ?>

<!-- Start Dashboard Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">

    <!-- Dashboard Header -->
    <h3 class="text-2xl font-bold mb-6"><?php echo htmlspecialchars($title); ?></h3>


    <!-- Total Emission -->
    <div class="mb-6">
        <h4 class="text-xl ">Carbon Footprint Summary</h4>
        <p class="text-xl text-green-600">
            <?php echo $totalEmission; ?> kg CO₂ <br>
        </p>
    </div>

    <!-- Filter by Date Range -->
    <form method="GET" class="flex flex-wrap items-center gap-4 mb-6">
        <div>
            <label for="start_date" class="block text-sm text-gray-700">Start Date:</label>
            <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($startDate); ?>" class="border rounded p-2">
        </div>
        <div>
            <label for="end_date" class="block text-sm text-gray-700">End Date:</label>
            <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>" class="border rounded p-2">
        </div>
        <div class="mt-6">
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Filter
            </button>
        </div>
    </form>

    <!-- Transaction List -->
    <div class="mb-6">
        <h4 class="text-m">Total Transactions (<?php echo $transactionCount; ?>)</h4>
        <table class="table-auto w-full mt-4">
            <thead>
                <tr>
                    <th class="px-4 py-2 border">Date</th>
                    <th class="px-4 py-2 border">Category</th>
                    <th class="px-4 py-2 border">Description</th>
                    <th class="px-4 py-2 border">Emission (kg CO₂)</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($transactions as $transaction): ?>
                    <tr>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($transaction['formatted_date']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($transaction['category']); ?></td>
                        <td class="px-4 py-2 border"><?php echo htmlspecialchars($transaction['description']); ?></td>
                        <td class="px-4 py-2 border"><?php echo number_format($transaction['converted_emission'], 2); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>
<!-- End Dashboard Content Area -->

<?php include $this->resolve("partials/_footer.php"); ?>