<template>
    <div>
        <section class="bg-white dark:bg-gray-900">
            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-white sm:text-4xl dark:text-white">
                        1.Javascript Rewrite the following function without using loops (for, while, foreach etc).</h2>
                    <pre class="text-white text-sm dark:text-white whitespace-pre-wrap">
const parseFilterUrl = (url) => {
    const parts = url.split('|');
    let filters = [];
    filters = parts.map((part) => {
        const split = part.split(':');
        let name = split[0];
        return { name: split[1].split(',') };
    });
    return filters;
}
                    </pre>
                </div>
            </div>

            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-white sm:text-4xl dark:text-white">
                        2.</h2>
                    <p class="text-white text-sm dark:text-white whitespace-pre-wrap">
                        I would create another branch named 'release/1.3.9-for-production'.
                        Then I would cherry pick all the commits/changes that has been approved to be pushed to prod
                        After selecting all the commits I would create a pull request to the 1.3.8 branch then merge the
                        changes
                    </p>
                </div>
            </div>

            <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
                <div class="mx-auto max-w-screen-md sm:text-center">
                    <h2 class="mb-4 text-3xl tracking-tight font-extrabold text-white sm:text-4xl dark:text-white">3
                    </h2>

                    <form class="space-y-8">
                        <div>
                            <label for="digit"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300 text-left">
                                Digit</label>
                            <input type="number" id="digit" v-model="digit"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                                required ondrop="return false" onpaste="return false"
                                onkeypress="return event.charCode >= 48 && event.charCode <= 57">
                        </div>
                        <div>
                            <label for="text"
                                class="block mb-2 text-left text-sm font-medium text-gray-900 dark:text-gray-300">Text</label>
                            <input type="text" id="text" v-model="text"
                                class="block p-3 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 shadow-sm focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                                 required>
                        </div>

                        <p v-show="convertedValue" v-text="convertedValue" class="text-white"></p>

                        <button @click="convert" type="button"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Convert</button>
                    </form>

                </div>
            </div>

        </section>
    </div>
</template>
<script setup>
import axios from 'axios';
import Swal from 'sweetalert2'
import { ref, computed, watch, } from 'vue';

let baseUrl = ref("http://127.0.0.1:8000/api");
let digit = ref('');
let text = ref('');
let convertedValue = ref('');

let errorAlert = (text, icon, confirmButtonText) => {
    Swal.fire({
        title: 'Error!',
        text: text,
        icon: icon,
        confirmButtonText: confirmButtonText
    })
}

let convert = () => {
    if (!digit.value && !text.value) {
        errorAlert('Please provide a value to either the Digit or Text',
            'error',
            'OK');
    } else {
        let fields = {
            "string": text.value,
            "number": digit.value,
        };

        axios.post(baseUrl.value + "/convert", fields)
            .then(response => {
                if (response.status == 200) {
                    convertedValue.value = response.data.converted + 'USD';
                    text.value = response.data.string;
                    digit.value = response.data.digit;
                    console.log(response);
                }
            })
            .catch(error => {
                errorAlert(error.response.data.message ?? 'Something went wrong!', 'error', 'OK');
                console.error("There was an error!", error.response.data.message);
            });

    }

}

</script>
