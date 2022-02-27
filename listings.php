<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body class="bg-background font-roboto h-screen">
    <script src="https://unpkg.com/vue@next"></script>
    <script src="listing.js"></script>
    <div class="flex flex-col h-full">

        <div class="flex flex-row flex-none justify-between items-end p-4 bg-surface">
            <div class="flex flex-col gap-y-2">
                <p class="text-primary">Home <span class="text-black">&gt;</span></p>
                <p class="text-2xl text-black">Listings Management</p>
            </div>
            <div class="bg-primary max-h-10">
                <button class="button px-2 py-2 text-on-primary">Add new listing</button>
            </div>
        </div>

        <div class="bg-surface mt-2 h-full">
            <div class="mx-10 mt-5 mb-10">
                <div class="flex flex-col">
                    <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow-md sm:rounded-lg">
                                <table class="min-w-full">
                                    <thead class="bg-gray-50 dark:bg-gray-700">
                                        <tr>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Product Name
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Product Price
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Product Category
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Product Stock
                                            </th>
                                            <th scope="col"
                                                class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_container">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="js/axios.min.js"></script>
<script>
    sendReq();
    function sendReq() {

        const table_container = document.getElementById('table_container');

        // Remove all existing child rows from table except the table header
        while (table_container.childElementCount > 1) {
            table_container.removeChild(table_container.lastChild);
        }

        // Send a request to our API and receive json data containing all listings made by the seller
        axios
            .post('/sports_place/helpers/listing_helper.php', {
                'session_token': "94e8a84a4ab2c5257effbc3af37d8096",
                'mode': "list",
            })
            .then(function (response) {
                response.data.forEach(element => {
                    const newRow = document.createElement('tr');
                    table_container.appendChild(newRow);
                    newRow.classList.add('bg-white', 'border-b', 'dark:bg-gray-800', 'dark:border-gray-700');
                    const items = ['product_full_name', 'product_price', 'product_quantity', 'product_rating', 'actions'];
                    items.forEach(item => {

                        const newTD = document.createElement('td');
                        newRow.appendChild(newTD);
                        newTD.classList.add('py-4', 'px-6', 'text-sm', 'text-gray-500', 'whitespace-nowrap', 'dark:text-white');

                        if (item == "actions") {
                            Icon1 = document.createElement('i');
                            newTD.appendChild(Icon1);
                            Icon1.classList.add('fas', 'fa-edit', 'text-primary', 'px-1');
                            Icon1.title = "Edit Product Details";

                            Icon2 = document.createElement('i');
                            newTD.appendChild(Icon2);
                            Icon2.classList.add('fas', 'fa-trash-alt', 'text-error', 'px-1');
                            Icon2.title = "Delete Product";
                            Icon2.setAttribute("onclick", "deleteListing(" + element['product_id'] + ")");
                        }
                        else if (item == "product_full_name") {
                            newTD.classList.add('font-medium', 'flex', 'flex-row', 'gap-x-2', 'items-center', 'text-gray-900', 'dark:text-white');

                            const newImage = document.createElement('img');
                            newTD.appendChild(newImage);
                            newImage.src = element['product_main_image'];
                            newImage.classList.add('w-10');

                            const newPara = document.createElement('p');
                            newTD.appendChild(newPara);
                            newPara.innerHTML = element[item];
                        }
                        else if (item == "product_price") {

                            newTD.innerHTML = '$' + element[item];
                        }
                        else {
                            newTD.innerHTML = element[item];
                        }
                    });
                });
            });
    }
    function deleteListing(product_id) {
        if (product_id == null)
            return;

        axios.get('/sports_place/helpers/listing_helper.php', {
            params: {
                mode: 'delete',
                product_id,
            }
        })
            .then(function (response) {
                console.log(response);
                sendReq();
            });
    }
</script>
<link href="css/all.css" rel="stylesheet" type="text/css" />
<script src="css/tailwind.css"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'primary': '#6750a4',
                    'on-primary': '#ffffff',
                    'primary-container': '#eaddff',
                    'on-primary-container': '#21005d',
                    'secondary': '#625b71',
                    'on-secondary': '#ffffff',
                    'secondary-container': '#e8def8',
                    'on-secondary-container': '#1d192b',
                    'tertiary': '#7d5260',
                    'on-tertiary': '#ffffff',
                    'tertiary-container': '#ffd8e4',
                    'on-tertiary-container': '#31111d',
                    'error': '#b3261e',
                    'error-container': '#f9dedc',
                    'on-error': '#ffffff',
                    'on-error-container': '#410e0b',
                    'background': '#fffbfe',
                    'on-background': '#1c1b1f',
                    'surface': '#f3eff3',
                    'on-surface': '#1c1b1f',
                    'surface-variant': '#e7e0ec',
                    'on-surface-variant': '#49454f',
                    'outline': '#79747e',
                    'inverse-on-surface': '#f4eff4',
                    'inverse-surface': '#313033',
                    'primary-light': '#6750a4',
                    'on-primary-light': '#ffffff',
                    'primary-container-light': '#eaddff',
                    'on-primary-container-light': '#21005d',
                    'secondary-light': '#625b71',
                    'on-secondary-light': '#ffffff',
                    'secondary-container-light': '#e8def8',
                    'on-secondary-container-light': '#1d192b',
                    'tertiary-light': '#7d5260',
                    'on-tertiary-light': '#ffffff',
                    'tertiary-container-light': '#ffd8e4',
                    'on-tertiary-container-light': '#31111d',
                    'error-light': '#b3261e',
                    'error-container-light': '#f9dedc',
                    'on-error-light': '#ffffff',
                    'on-error-container-light': '#410e0b',
                    'background-light': '#fffbfe',
                    'on-background-light': '#1c1b1f',
                    'surface-light': '#fffbfe',
                    'on-surface-light': '#1c1b1f',
                    'surface-variant-light': '#e7e0ec',
                    'on-surface-variant-light': '#49454f',
                    'outline-light': '#79747e',
                    'inverse-on-surface-light': '#f4eff4',
                    'inverse-surface-light': '#313033',
                    'primary-dark': '#d0bcff',
                    'on-primary-dark': '#381e72',
                    'primary-container-dark': '#4f378b',
                    'on-primary-container-dark': '#eaddff',
                    'secondary-dark': '#ccc2dc',
                    'on-secondary-dark': '#332d41',
                    'secondary-container-dark': '#4a4458',
                    'on-secondary-container-dark': '#e8def8',
                    'tertiary-dark': '#efb8c8',
                    'on-tertiary-dark': '#492532',
                    'tertiary-container-dark': '#633b48',
                    'on-tertiary-container-dark': '#ffd8e4',
                    'error-dark': '#f2b8b5',
                    'error-container-dark': '#8c1d18',
                    'on-error-dark': '#601410',
                    'on-error-container-dark': '#f9dedc',
                    'background-dark': '#1c1b1f',
                    'on-background-dark': '#e6e1e5',
                    'surface-dark': '#1c1b1f',
                    'on-surface-dark': '#e6e1e5',
                    'surface-variant-dark': '#49454f',
                    'on-surface-variant-dark': '#cac4d0',
                    'outline-dark': '#938f99',
                    'inverse-on-surface-dark': '#1c1b1f',
                    'inverse-surface-dark': '#e6e1e5',
                    'primary-100': '#ffffff',
                    'primary-99': '#fffbfe',
                    'primary-95': '#f6edff',
                    'primary-90': '#eaddff',
                    'primary-80': '#d0bcff',
                    'primary-70': '#b69df8',
                    'primary-60': '#9a82db',
                    'primary-50': '#7f67be',
                    'primary-40': '#6750a4',
                    'primary-30': '#4f378b',
                    'primary-20': '#381e72',
                    'primary-10': '#21005d',
                    'primary-0': '#000000',
                    'secondary-100': '#ffffff',
                    'secondary-99': '#fffbfe',
                    'secondary-95': '#f6edff',
                    'secondary-90': '#e8def8',
                    'secondary-80': '#ccc2dc',
                    'secondary-70': '#b0a7c0',
                    'secondary-60': '#958da5',
                    'secondary-50': '#7a7289',
                    'secondary-40': '#625b71',
                    'secondary-30': '#4a4458',
                    'secondary-20': '#332d41',
                    'secondary-10': '#1d192b',
                    'secondary-0': '#000000',
                    'tertiary-100': '#ffffff',
                    'tertiary-99': '#fffbfa',
                    'tertiary-95': '#ffecf1',
                    'tertiary-90': '#ffd8e4',
                    'tertiary-80': '#efb8c8',
                    'tertiary-70': '#d29dac',
                    'tertiary-60': '#b58392',
                    'tertiary-50': '#986977',
                    'tertiary-40': '#7d5260',
                    'tertiary-30': '#633b48',
                    'tertiary-20': '#492532',
                    'tertiary-10': '#31111d',
                    'tertiary-0': '#000000',
                    'neutral-100': '#ffffff',
                    'neutral-99': '#fffbfe',
                    'neutral-95': '#f4eff4',
                    'neutral-90': '#e6e1e5',
                    'neutral-80': '#c9c5ca',
                    'neutral-70': '#aeaaae',
                    'neutral-60': '#939094',
                    'neutral-50': '#787579',
                    'neutral-40': '#605d62',
                    'neutral-30': '#484649',
                    'neutral-20': '#313033',
                    'neutral-10': '#1c1b1f',
                    'neutral-0': '#000000',
                    'neutral-variant-100': '#ffffff',
                    'neutral-variant-99': '#fffbfe',
                    'neutral-variant-95': '#f5eefa',
                    'neutral-variant-90': '#e7e0ec',
                    'neutral-variant-80': '#cac4d0',
                    'neutral-variant-70': '#aea9b4',
                    'neutral-variant-60': '#938f99',
                    'neutral-variant-50': '#79747e',
                    'neutral-variant-40': '#605d66',
                    'neutral-variant-30': '#49454f',
                    'neutral-variant-20': '#322f37',
                    'neutral-variant-10': '#1d1a22',
                    'neutral-variant-0': '#000000',
                    'primary-100': '#ffffff',
                    'primary-99': '#fffbfe',
                    'primary-95': '#f6edff',
                    'primary-90': '#eaddff',
                    'primary-80': '#d0bcff',
                    'primary-70': '#b69df8',
                    'primary-60': '#9a82db',
                    'primary-50': '#7f67be',
                    'primary-40': '#6750a4',
                    'primary-30': '#4f378b',
                    'primary-20': '#381e72',
                    'primary-10': '#21005d',
                    'primary-0': '#000000',
                    'secondary-100': '#ffffff',
                    'secondary-99': '#fffbfe',
                    'secondary-95': '#f6edff',
                    'secondary-90': '#e8def8',
                    'secondary-80': '#ccc2dc',
                    'secondary-70': '#b0a7c0',
                    'secondary-60': '#958da5',
                    'secondary-50': '#7a7289',
                    'secondary-40': '#625b71',
                    'secondary-30': '#4a4458',
                    'secondary-20': '#332d41',
                    'secondary-10': '#1d192b',
                    'secondary-0': '#000000',
                    'tertiary-100': '#ffffff',
                    'tertiary-99': '#fffbfa',
                    'tertiary-95': '#ffecf1',
                    'tertiary-90': '#ffd8e4',
                    'tertiary-80': '#efb8c8',
                    'tertiary-70': '#d29dac',
                    'tertiary-60': '#b58392',
                    'tertiary-50': '#986977',
                    'tertiary-40': '#7d5260',
                    'tertiary-30': '#633b48',
                    'tertiary-20': '#492532',
                    'tertiary-10': '#31111d',
                    'tertiary-0': '#000000',
                    'neutral-100': '#ffffff',
                    'neutral-99': '#fffbfe',
                    'neutral-95': '#f4eff4',
                    'neutral-90': '#e6e1e5',
                    'neutral-80': '#c9c5ca',
                    'neutral-70': '#aeaaae',
                    'neutral-60': '#939094',
                    'neutral-50': '#787579',
                    'neutral-40': '#605d62',
                    'neutral-30': '#484649',
                    'neutral-20': '#313033',
                    'neutral-10': '#1c1b1f',
                    'neutral-0': '#000000',
                    'neutral-variant-100': '#ffffff',
                    'neutral-variant-99': '#fffbfe',
                    'neutral-variant-95': '#f5eefa',
                    'neutral-variant-90': '#e7e0ec',
                    'neutral-variant-80': '#cac4d0',
                    'neutral-variant-70': '#aea9b4',
                    'neutral-variant-60': '#938f99',
                    'neutral-variant-50': '#79747e',
                    'neutral-variant-40': '#605d66',
                    'neutral-variant-30': '#49454f',
                    'neutral-variant-20': '#322f37',
                    'neutral-variant-10': '#1d1a22',
                    'neutral-variant-0': '#000000',
                    'error-100': '#ffffff',
                    'error-99': '#fffbf9',
                    'error-95': '#fceeee',
                    'error-90': '#f9dedc',
                    'error-80': '#f2b8b5',
                    'error-70': '#ec928e',
                    'error-60': '#e46962',
                    'error-50': '#dc362e',
                    'error-40': '#b3261e',
                    'error-30': '#8c1d18',
                    'error-20': '#601410',
                    'error-10': '#410e0b',
                    'error-0': '#000000',
                },
                boxShadow: {
                    'lvl1': '0px 1px 5px 0px rgba(0, 0, 0, 0.2),0px 2px 2px 0px rgba(0, 0, 0, 0.14),0px 3px 1px -2px rgba(0, 0, 0, 0.12)',
                },
                fontFamily: {
                    'roboto': 'Roboto',
                    'product-sans': 'Product Sans',
                }
            }
        }
    }
</script>
<style>
    .md-display-large {
        font-family: 'Product Sans';
        line-height: 64px;
        font-size: 57px;
        letter-spacing: 0em;
    }

    .md-headline-large {
        font-family: 'Product Sans';
        line-height: 40px;
        font-size: 2rem;
        letter-spacing: 0px;
        font-weight: 400;
    }

    .md-title-large {
        font-family: 'Product Sans';
        line-height: 28px;
        font-size: 1.375rem;
        letter-spacing: 0px;
        font-weight: 400;
    }

    .md-title-md {
        font-family: 'Roboto';
        line-height: 1.5rem;
        font-size: 1rem;
        letter-spacing: 0.009375em;
        font-weight: 500;
    }

    .md-title-small {
        font-family: 'Roboto';
        line-height: 1.25rem;
        font-size: 0.875rem;
        letter-spacing: 0.00625rem;
        font-weight: 500;
    }

    .md-label-large {
        font-family: 'Roboto';
        line-height: 20px;
        font-size: 14px;
        letter-spacing: 0.1px;
        font-weight: 500;
    }

    .md-label-small {
        font-family: 'Roboto';
        line-height: .375rem;
        font-size: .6875rem;
        letter-spacing: .03125rem;
        font-weight: 500;
    }

    .md-label-medium {
        font-family: 'Roboto';
        line-height: 1rem;
        font-size: .75rem;
        letter-spacing: .03125rem;
        font-weight: 500;
    }
</style>

</html>