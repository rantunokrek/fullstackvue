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
                                    <button class="_btn _action_btn view_btn1" type="button">View</button>

                                    <button class="_btn _action_btn make_btn1" type="button">Delete</button>
                                </td>
                            </tr>
                            <!-- ITEMS -->


                            <!-- ITEMS -->


                        </table>
                    </div>
                </div>
                <Modal v-model="addModal" title="Add Tag" @on-ok="ok" @on-cncel="cancel">
                    <Input type="text" v-model="data.tagName" placeholder="add Your tag" />

                    <div slot="footer">
                        <Button type="default" @click="addModal = false">Close</Button>
                        <Button type="primary" @click="addTag" :disabled="isAdding" :loadind="isAdding">{{ isAdding ?
                            'Adding..' : 'Add tag' }}</Button>
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
            isAdding: false,
            // tag show
            tags: []

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