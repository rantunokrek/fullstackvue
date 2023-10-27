<template>
    <div>
        <div class="content">
            <div class="container-fluid">
                <h1>I will show how all other components react to changes</h1>
                <h2>The master component : {{ counter }} </h2>

                <div>
                    <comA></comA>
                </div>
                <div>
                    <comB></comB>
                </div>
                <div>
                    <comC></comC>
                </div>



                <Button type="info" @click="changeCounter">Change the state of the counter</Button>
            </div>

        </div>

    </div>
</template>


<script>
import ComA from './comA.vue'
import ComB from './comB.vue'
import ComC from './comC.vue'
import { mapGetters, mapActions } from 'vuex'
export default {
    data() {
        return {

        }
    },
    method: {
        ...mapActions([
            'changeCounterAction'
        ])
    },
    computed: {
        ...mapGetters({
            'counter': 'getCounter'
        })
    },
    methods: {
        changeCounter() {
            this.$store.dispatch('changeCounterAction', 1)

            // this.$store.commit('changeTheCounter', 1)
        },
        runSomethingWhenCahnge() {
            console.log('I am running')
        }
    },
    created() {
        console.log(this.$store.state.counter)
    },

    components: {
        ComA,
        ComB,
        ComC
    },
    watch: {
        counter(value) {
            console.log('counter is changing', value)
            this.runSomethingWhenCahnge()

        }
    }

}


</script>