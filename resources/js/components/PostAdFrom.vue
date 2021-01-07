<template>
    <div>
        <div class='flex justify-center'>
            <div class='bg-green-300 w-96 p-3' v-show="success">
                Ad Saved Successfully
            </div>
        </div>

        <form class="grid sm:grid-cols-1" @submit.prevent="submitAdFrom" enctype='multipart/form-data'>
            <div class="flex justify-center">
                <div class="w-96">
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Ad Title *</label>
                        <input v-model="fields.title" type="text" name="title" placeholder="Ad title..." class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.title">
                            {{errors.title[0]}}
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Price *</label>
                        <input v-model="fields.price" type="number" name="price" placeholder="Price" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.price">
                            {{errors.price[0]}}
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Currency *</label>
                        <select v-model="fields.currency" name="currency" placeholder="Currency" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                            <option v-for="currency in currencies" :value="currency.currency_id">{{currency.currency_name}}</option>
                        </select>
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.currency">
                            {{errors.currency[0]}}
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Category *</label>
                        <select v-model="fields.category" name="category" placeholder="Currency" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                            <option v-for="category in categories" :value="category.category_id">{{category.category_name}}</option>
                        </select>
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.category">
                            {{errors.category[0]}}
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Contact Number *</label>
                        <input v-model="fields.contact_number" type="text" name="contact_number" placeholder="Contact Number" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.contact_number">
                            {{errors.contact_number[0]}}
                        </div>
                    </div>
                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Email *</label>
                        <input v-model="fields.email" type="email" name="email" placeholder="Email" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200">
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.email">
                            {{errors.email[0]}}
                        </div>
                    </div>

                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Image Upload *</label>
                        <input @change="processFile" type="file" name="image" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200" accept='image/*' multiple>
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.image">
                            {{errors.image[0]}}
                        </div>
                    </div>

                    <div class="w-full mb-4">
                        <label class="text-gray-500 font-bold">Description *</label>
                        <textarea v-model="fields.description" name='description' placeholder="Description" class="w-full bg-white-200 white border-gray-200 rounded p-2 focus:outline-none focus:border-gray-200"></textarea>
                        <div class='p-3 mt-1 text-red-300' v-if="errors && errors.description">
                            {{errors.description[0]}}
                        </div>
                    </div>

                    <div class="w-full mb-4">
                        <button class="w-full bg-red-400 uppercase text-white p-3 hover:bg-red-300">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
            //get csrf token
            this.fields._token=$('meta[name="csrf-token"]').attr('content')

            //define proper images as objct
            this.fields.images = []

            //get categories
            axios.get("/get_categories_currencies")
                .then(response=>{
                    this.categories = response.data.get_categories
                    this.currencies = response.data.get_currencies
                })
        },
        data(){
            return {
                categories:null,
                currencies:null,
                success:false,
                errors:null,
                fields:{}
            }
        },
        methods:{
            submitAdFrom(){
                //console.log(this.fields)
                axios.post("/post-ad", this.fields)
                    .then(response=>{
                        console.log(response.data.message)
                        this.success = true
                        this.errors = null
                        this.fields = {}
                    })
                    .catch(error=>{
                        this.errors = error.response.data.errors
                    })
            },
            processFile(event){
                let imageFiles = event.target.files
                console.log(imageFiles)
                let totalFiles = imageFiles.length

                for (let i = 0; i < totalFiles; i++) {
                    let reader = new FileReader();
                    reader.readAsDataURL(imageFiles[i]);
                    reader.onload = e => {
                        this.fields.images.push(e.target.result)
                    }
                }
            }
        }
    }
</script>
