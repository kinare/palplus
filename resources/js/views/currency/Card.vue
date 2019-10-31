<template>
    <section>
            <div class="columns is-multiline">
                <div class="column">
                    <b-field label="Access type">
                        <b-select placeholder="Select Access type">
                            <option>Editor</option>
                            <option>Viewer</option>
                        </b-select>
                    </b-field>
                </div>
                <div class="column">
                    <b-field label="Full Names">
                        <b-input type="text" placeholder="Full Names"></b-input>
                    </b-field>
                </div>
                <div class="column"></div>
            </div>
    </section>
</template>

<script>
    import BField from "buefy/src/components/field/Field";
    import BInput from "buefy/src/components/input/Input";
    export default {
        name: "Card",
        components: {BInput, BField}
    }
</script>

<style scoped>

</style>
