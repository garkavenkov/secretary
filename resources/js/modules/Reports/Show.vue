<template>

    <breadcrumbs />

    <div class="card">
        <div class="card-header">
            Інформація о звіті {{ id }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Назва
                        </div>
                        <div class="col-md-8">
                            Довідка про стан сім'ї
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Опис
                        </div>
                        <div class="col-md-8">
                            Довідка про стан сім'ї
                        </div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-md-4">
                            Модель
                        </div>
                        <div class="col-md-8">
                            App\Models\HouseholdMember
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label for="formFile" class="form-label">Шаблон документа</label>
                        </div>
                        <div class="col-md-8">
                            <input class="form-control" type="file" id="templateFile" name="template" @change="uploadImage($event)">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row mb-3" v-for="(variable, index) in templateVariables" :key="index">
                        <div class="col-md-6">{{ variable }}</div>
                        <div class="col-md-6">memberFullName</div>
                    </div>

                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    name: 'ReportsShow',
    props: {
        'id': {
            type: [String, Number],
            required: true,
        }
    },
    data() {
        return {
            templateVariables: [],

        }
    },
    methods: {
        uploadImage(e) {
            console.log(e.target.files[0])
            const URL = `/api/v1/upload-report-template/${this.id}`;

            let data = new FormData();
            data.append('name', 'template');
            data.append('file', e.target.files[0]);
            console.log(data);
            let config = {
                headers : {
                    'Content-Type' : 'multipart/form-data'
                }
            }

            axios.post(
                URL,
                data,
                config
            ).then(res => {
                if (res.status == 200) {
                    this.templateVariables = res.data.variables;
                    // this.fetchData()
                    // this.$swal({
                    //     toast: true,
                    //     position: 'top-end',
                    //     showConfirmButton: false,
                    //     timer: 2000,
                    //     html:res.data.message,
                    //     icon:'success',
                    // });
                }

            })
        }
    }
}

</script>
