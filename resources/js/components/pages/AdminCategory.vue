<template>
    <div>
        <div class="content">
            <div class="container-fluid">

                <!--~~~~~~~ TABLE ONE ~~~~~~~~~-->
                <div class="_1adminOverveiw_table_recent _box_shadow _border_radious _mar_b30 _p20">
                    <p class="_title0">Category page</p>

                    <div class="_overflow _table_div">
                        <table class="_table">
                            <!-- TABLE TITLE -->
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
                                <th>Category Name</th>
                                <th>Action</th>
                            </tr>
                            <!-- TABLE TITLE -->


                            <!-- ITEMS -->
                            <tr>
                                <td>01</td>
                                <td class="_table_name">Manhattan's art center "Shed" opening ceremony</td>
                                <td>Economy</td>
                                <td>
                                    <button class="_btn _action_btn view_btn1" type="button">View</button>
                                    <button class="_btn _action_btn edit_btn1" type="button">Edit</button>
                                    <button class="_btn _action_btn make_btn2" type="button">Make Features</button>
                                    <button class="_btn _action_btn make_btn3" type="button">Make Card</button>
                                    <button class="_btn _action_btn make_btn1" type="button">Delete</button>
                                </td>
                            </tr>
                            <!-- ITEMS -->


                            <!-- ITEMS -->


                        </table>
                    </div>
                </div>
                <Page :total="100" />

            </div>
        </div>
    </div>
</template>