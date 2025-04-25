<?php include $this->resolve("partials/_header.php"); ?>

<!-- Start Green Options Content Area -->
<section class="container mx-auto mt-12 p-4 bg-white shadow-md border border-gray-200 rounded">

    <h3 class="text-2xl font-bold mb-6"><?php echo htmlspecialchars($title); ?></h3>
    <p class="mb-6 text-lg">Explore these green activities to reduce your carbon footprint and contribute to a sustainable future!</p>

    <!-- Green Activities Table -->
    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="px-4 py-2 border text-left text-black">Activity</th>
                    <th class="px-4 py-2 border text-left text-black">Description</th>
                </tr>
            </thead>
            <tbody>
                <!-- Row 1: Reduce Electricity Usage -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Reduce Electricity Usage</td>
                    <td class="px-4 py-2 border text-black">Turn off lights and appliances when not in use. Switch to energy-efficient LED bulbs.</td>
                </tr>

                <!-- Row 2: Use Public Transportation -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Use Public Transportation</td>
                    <td class="px-4 py-2 border text-black">Opt for buses, trains, or shared rides to lower your personal transportation emissions.</td>
                </tr>

                <!-- Row 3: Eat Plant-Based Meals -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Eat Plant-Based Meals</td>
                    <td class="px-4 py-2 border text-black">Reduce meat consumption. Try plant-based meals to lower the carbon footprint of your diet.</td>
                </tr>

                <!-- Row 4: Reduce Waste & Recycle -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Reduce Waste & Recycle</td>
                    <td class="px-4 py-2 border text-black">Reduce, reuse, and recycle materials to minimize landfill waste and reduce emissions.</td>
                </tr>

                <!-- Row 5: Plant Trees -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Plant Trees</td>
                    <td class="px-4 py-2 border text-black">Planting trees helps absorb CO₂, combat climate change, and restore natural ecosystems.</td>
                </tr>

                <!-- Row 6: Solar Energy -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Switch to Solar Energy</td>
                    <td class="px-4 py-2 border text-black">Install solar panels to power your home and reduce reliance on fossil fuels.</td>
                </tr>

                <!-- Row 7: Eco-friendly Transportation -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Eco-friendly Transportation</td>
                    <td class="px-4 py-2 border text-black">Switch to electric vehicles (EVs) or use bike-sharing programs for eco-friendly commuting.</td>
                </tr>

                <!-- Row 8: Support Sustainable Brands -->
                <tr class="hover:bg-gray-100">
                    <td class="px-4 py-2 border text-black">Support Sustainable Brands</td>
                    <td class="px-4 py-2 border text-black">Buy from brands that prioritize sustainability and reduce environmental impact.</td>
                </tr>

            </tbody>
        </table>
    </div>
</section>
<!-- End Green Options Content Area -->

<?php include $this->resolve("partials/_footer.php"); ?>