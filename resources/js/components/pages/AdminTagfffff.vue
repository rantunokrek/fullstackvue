<template>
    <div>
        <div class="content">
            <div class="container-fluid">

                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Tag <Button @click="addModal = true">
                            <Icon type="md-add" />Add tag
                        </Button></p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>Id</th>
                                <th>Tag Name</th>
                                <th>Created Time</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->


                            <!-- ITEMS -->
                            <tr v-for="(tag, i) in tags" :key="i" v-if="tags.length">
                                <td>{{ tag.id }}</td>
                                <td class="_table_name">{{ tag.tagName }}</td>
                                <td class="">{{ tag.created_at }}</td>

                                <td>

                                    <Button type="info" size="small" @click="showEditData(tag, i)"> Edit </Button>

                                    <Button type="error" size="small" @click="showDeletingModal(tag, i)"
                                        :loading="tag.isDeleting">Delete</Button>
                                </td>
                            </tr>
                            <!-- ITEMS -->


                            <!-- ITEMS -->


                        </table>
                    </div>
                </div>
                <!-- add model modal -->
                <Modal v-model="addModal" title="Add Tag" :mask-closable="false" :closable="false">
                    <Input type="text" v-model="data.tagName" placeholder="add Your tag" filed="required" />

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addTag" :disabled="isAdding" :loadind="isAdding">{{ isAdding ?
                            'Adding..' : 'Add tag' }}</Button>
                    </div>

                </Modal>


                <!-- Edit model modal -->
                <Modal v-model="editModal" title="Edit Tag" :mask-closable="false" :closable="false">
                    <Input type="text" v-model="editData.tagName" placeholder="Edit Your tag" required />

                    <div slot="footer">
                        <Button type="default" @click="editModal = false">Close</Button>
                        <Button type="primary" @click="editTag" :disabled="isAdding" :loadind="isAdding">{{ isAdding ?
                            'Adding..' : 'update' }}</Button>
                    </div>

                </Modal>


                <!-- Delete model modal -->
                <Modal v-model="showDeleteModal" width="360">
                    <p slot="header" style="color:#f60;text-align:center">
                        <Icon type="ios-information-circle"></Icon>
                        <span>Delete Confirmation</span>
                    </p>
                    <div style="text-align:center">
                        <p>Are Sure You want to Delete tag?</p>

                    </div>
                    <div slot="footer">

                        <Button type="error" size="large" long :loading="isDeleing" :disabled="isDeleing"
                            @click="deleteTag"> Delete</Button>
                    </div>

                </Modal>



            </div>
        </div>
    </div>
</template>
<script>
import { Icon } from 'view-design';

export default {
    data() {
        return {
            data: {
                tagName: ''
            },
            addModal: false,
            editModal: false,
            isAdding: false,
            // tag show
            tags: [],
            editData: {
                tagName: ''
            },
            index: -1,
            showDeleteModal: false,
            isDeleing: false,
            deleteItem: {},
            deletingIndex: -1

        };
    },
    methods: {
        async addTag() {
            if (this.data.tagName.trim() == '') return this.e('Tag name is Reuired!')
            const res = await this.callApi('post', 'app/create_tag', this.data)
            if (res.status === 201) {
                this.s('Tag has been added successfully!')
                // create koro sathe sathei refresh hobe unshift
                this.tags.unshift(res.data)
                this.addModal = false;
                this.data.tagName = ''
            } else {
                this.swr()
            }
        },


        async editTag() {
            if (this.editData.tagName.trim() == '') return this.e('Tag name is Reuired!')
            const res = await this.callApi('post', 'app/edit_tag', this.editData)
            if (res.status === 200) {
                this.tags[this.index].tagName = this.editData.tagName
                this.s('Tag has been edited successfully!')

                this.editModal = false;

            } else {
                this.swr()
            }
        },
        showEditData(tag, index) {
            let obj = {
                id: tag.id,
                tagName: tag.tagName
            }

            this.editData = obj
            this.editModal = true
            this.index = index

        },
        async deleteTag() {
            this.isDeleing = true
            const res = await this.callApi('post', 'app/delete_tag', this.deleteItem)
            if (res.status === 200) {
                deletingIndex: -1
                this.tags.splice(this.deletingIndex, 1)
                this.s('Tag has been deleted successfully!')
            } else {
                this.swr()
            }
            this.isDeleing = false
            this.showDeleteModal = false


        },
        showDeletingModal(tag, i) {
            this.deleteItem = tag
            this.deletingIndex = i
            this.showDeleteModal = true
        }
    },
    async created() {
        const res = await this.callApi('get', 'app/get_tags')
        if (res.status === 200) {
            this.tags = res.data

        } else {
            this.swr()
        }
    }

    // components: { Icon }
}
</script>