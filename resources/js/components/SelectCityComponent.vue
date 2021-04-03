<template>
    <div>
        <div class="form-group required" >
            <label for="input-country" class="col-sm-2 control-label">استان</label>
            <div class="col-sm-10">
                <select class="form-control" id="input-country" name="province" v-model="province" @change="getAllCities()">
                    <option value="">--- لطفا انتخاب کنید ---</option>
                    <option v-for="province in provinces" :value="province.id">{{province.name}}</option>

                </select>
            </div>
        </div>
        <div class="form-group required" v-if="cities.length > 0">
            <label for="input-zone" class="col-sm-2 control-label">شهر</label>
            <div class="col-sm-10">
                <select class="form-control" id="input-zone" name="city">
                    <option value=""> --- لطفا انتخاب کنید ---</option>
                    <option v-for="city in cities" :value="city.id">{{ city.name }}</option>
                </select>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            province:'--- لطفا انتخاب کنید ---',
            provinces:[],
            cities: [],
            flag: false,
        }
    },
    mounted() {
        axios.get('/api/provinces').then(res => {
            this.provinces = res.data.provinces
        }).catch(err => {
            console.log(err);
        })
    },
    methods: {
        getAllCities: function () {
            axios.get('/api/cities/' + this.province).then(res => {
                this.cities = res.data.cities
                console.log(res.data.cities)
            }).catch(err => {
                console.log(err);
            })
        }

    }

}
</script>
