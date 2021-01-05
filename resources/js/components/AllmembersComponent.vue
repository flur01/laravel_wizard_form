<template>
    <div class="d-flex flex-wrap justify-content-center">
        <table class="table table-striped">
            <thead class="thead-dark">
            <tr>
                <th scope="col">Photo</th>
                <th scope="col">Name</th>
                <th scope="col">Report subject</th>
                <th scope="col d-flex">Email</th>
                <th v-if="isAdmin" scope="col d-flex">Visible</th>
            </tr>
            </thead>
            <tbody>
                <tr v-for="(member, index) in members" :key="index">
                <td class="text-center w-25">
                    <img style="width: 200px; height: 200px;" class="img-thumbnail" :src="imageUrl + (member.photo || 'default.png' )">
                    
                </td>

                <td class="w-25 align-middle">
                    <h3>{{member.firstname}} {{member.lastname}}</h3>
                </td>

                <td class="w-25 align-middle">
                    <h3>{{member.report_subject}}</h3>
                </td>
                
                <td class="w-25 align-middle">
                    <h3>{{member.email}}</h3>
                </td>

                <td v-if="isAdmin" class="w-25 align-middle">
                    <input
                        type="checkbox" checked
                        v-if="member.visible" 
                        @click="changeVisible(member.id, !member.visible, index)">
                    
                    <input
                        type="checkbox" 
                        v-if="!member.visible" 
                        @click="changeVisible(member.id, !member.visible, index)">
        
                </td>
                </tr>
            </tbody>
        </table>
    </div>  
</template>

<script>
import axios from 'axios';

export default {
    props: ['csrf'],

    data() {
        return {
            members: {},
            imageUrl: '',
            isAdmin: false
        }
    },

    created() {
        this.getMembers();
    },

    methods: {
        getMembers() {
            axios.get('/get-all-members').then(response => {
                this.members = response.data.members;
                this.imageUrl = response.data.imageUrl + '/';
                this.isAdmin = response.data.isAdmin;
                console.log(response.data.members);
            });
        },

        changeVisible(memberId, memberVisible, index) {
            this.members[index].visible = memberVisible;
            axios.post('change-visible',{
                id: memberId,
                visible: memberVisible
            },
            {
                headers: {'X-CSRF-TOKEN': this.csrf}
            });
        }
    }
}
</script>