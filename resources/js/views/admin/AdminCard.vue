<template>
    <div class="Card has-background-white">
        <header class="card-header">
            <p class="card-header-title">Admin Card</p>
        </header>
        <div class="card-content">
            <div class="content has-text-left">
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="Access type">
                            <b-select expanded placeholder="Select Access type">
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
                    <div class="column">
                        <b-field label="Username">
                            <b-input type="text" placeholder="Username"></b-input>
                        </b-field>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="Phone">
                            <b-input type="text" placeholder="Full Names"></b-input>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="Email">
                            <b-input type="text" placeholder="Full Names"></b-input>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="Status">
                            <b-select expanded placeholder="Select status">
                                <option>Active</option>
                                <option>Inactive</option>
                            </b-select>
                        </b-field>
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <b-field label="WEF date">
                            <b-datepicker
                                    :show-week-number="showWeekNumber"
                                    placeholder="Click to select..."
                                    icon="calendar-today">
                            </b-datepicker>
                        </b-field>
                    </div>
                    <div class="column">
                        <b-field label="WET date">
                            <b-datepicker
                                    :show-week-number="showWeekNumber"
                                    placeholder="Click to select..."
                                    icon="calendar-today">
                            </b-datepicker>
                        </b-field>
                    </div>
                    <div class="column">
                    </div>
                </div>
                <div class="columns is-multiline">
                    <div class="column">
                        <div class="buttons">
                            <b-button type="is-primary" expanded>Submit</b-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import BField from "buefy/src/components/field/Field";
    import BInput from "buefy/src/components/input/Input";
    import BButton from "buefy/src/components/button/Button";
    import BDatepicker from "buefy/src/components/datepicker/Datepicker";
    export default {
        name: "AdminCard",
        components: {BDatepicker, BButton, BInput, BField}
    }
</script>

<style scoped>

</style>
