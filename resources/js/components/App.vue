<template>
    <el-container>
        <el-header>
            <h1>Property Search</h1>
        </el-header>
        <el-main>
            <el-form :model="searchForm" @submit.native.prevent="searchProperties">
                <el-form-item label="Name">
                    <el-input v-model="searchForm.name"></el-input>
                </el-form-item>
                <el-form-item label="Bedrooms">
                    <el-input v-model="searchForm.bedrooms" type="number"></el-input>
                </el-form-item>
                <el-form-item label="Bathrooms">
                    <el-input v-model="searchForm.bathrooms" type="number"></el-input>
                </el-form-item>
                <el-form-item label="Storeys">
                    <el-input v-model="searchForm.storeys" type="number"></el-input>
                </el-form-item>
                <el-form-item label="Garages">
                    <el-input v-model="searchForm.garages" type="number"></el-input>
                </el-form-item>
                <el-form-item label="Price Range">
                    <el-input v-model="searchForm.min_price" placeholder="Min Price" type="number"></el-input>
                    <el-input v-model="searchForm.max_price" placeholder="Max Price" type="number"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="searchProperties">Search</el-button>
                </el-form-item>
            </el-form>
            <el-table v-if="properties.length" :data="properties">
                <el-table-column prop="name" label="Name"></el-table-column>
                <el-table-column prop="bedrooms" label="Bedrooms"></el-table-column>
                <el-table-column prop="bathrooms" label="Bathrooms"></el-table-column>
                <el-table-column prop="storeys" label="Storeys"></el-table-column>
                <el-table-column prop="garages" label="Garages"></el-table-column>
                <el-table-column prop="price" label="Price"></el-table-column>
            </el-table>
            <el-alert v-else title="No results found" type="warning"></el-alert>
        </el-main>
    </el-container>
</template>

<script>
import { ref } from 'vue';
import axios from 'axios';

export default {
    setup() {
        const searchForm = ref({
            name: '',
            bedrooms: null,
            bathrooms: null,
            storeys: null,
            garages: null,
            min_price: null,
            max_price: null,
        });

        const properties = ref([]);
        const loading = ref(false);

        const searchProperties = async () => {
            loading.value = true;
            try {
                const response = await axios.get('/api/properties', { params: searchForm.value });
                properties.value = response.data;
            } catch (error) {
                console.error(error);
            } finally {
                loading.value = false;
            }
        };

        return { searchForm, properties, searchProperties, loading };
    }
};
</script>

<style scoped>
.el-container {
    padding: 20px;
}
</style>
