<template>
    <div>
        <hero-bar :has-right-visible="false">Communication</hero-bar>
        <section class="section is-main-section">
            <card-component
                title="Compose Message"
                class="has-mobile-sort-spaced"
            >
                <form>
                    <div class="columns">
                        <div class="column is-half">
                            <b-field grouped class="margin-top: 20px;">
                                <b-field expanded>
                                    <v-select
                                        @input="getCountryCode"
                                        :options="countries"
                                        label="country"
                                    ></v-select>
                                </b-field>
                                <b-field expanded>
                                    <b-input
                                        placeholder="Phone Number"
                                        v-model="form.phone"
                                    ></b-input>
                                </b-field>
                                <b-button
                                    @click.prevent="addPhoneNumberToList"
                                    type="is-primary"
                                    >Add</b-button
                                >
                            </b-field>
                        </div>
                        <div class="column is-half">
                            <b-field>
                                <b-input
                                    v-model="form.message"
                                    placeholder="Your message ..."
                                    type="textarea"
                                ></b-input>
                            </b-field>
                        </div>
                    </div>
                    <hr />
                    <section v-if="form.phoneList.length > 0">
                        <h3 class="subtitle is-2">Send to</h3>
                        <b-tooltip
                            position="is-bottom"
                            animated
                            v-for="(phone, index) in form.phoneList"
                            :key="index"
                            :label="phone"
                        >
                            <p class="button">{{ phone }}</p>
                        </b-tooltip>
                        <b-button
                            class="button"
                            @click="sendMessage"
                            type="is-info"
                            >Send</b-button
                        >
                    </section>
                </form>
            </card-component>
        </section>
    </div>
</template>

<script>
import HeroBar from "../../components/HeroBar";
import CardComponent from "../../components/CardComponent";
import { parsePhoneNumberFromString } from "libphonenumber-js";
import endpoints from "./../../store/endpoints";
import call from "./../../modules/api";
import VSelect from "vue-select";

export default {
    name: "Dashboard",
    components: {
        CardComponent,
        HeroBar,
        VSelect,
    },
    beforeRouteEnter(to, from, next) {
        next((v) => {
            v.$store.dispatch("Admin/getStats");
            v.$store.dispatch("Currency/getCurrency");
        });
    },
    computed: {
        stats() {
            return this.$store.getters["Admin/stats"];
        },
        countries() {
            return this.$store.getters["Currency/currency"];
        },
    },
    created() {
        console.log(this.countries);
    },
    data() {
        return {
            form: {
                code: "",
                phone: "",
                phoneList: [],
                message: "",
            },
            errors: {
                code: false,
                phone: false,
                phoneList: false,
                message: false,
            },
        };
    },
    methods: {
        getCountryCode(item) {
            if (item) {
                this.form.code = item.dial_code;
            }
        },
        addPhoneNumberToList() {
            if (!this.form.code) {
                this.errors.code = true;
                return false;
            }
            if (!this.form.phone) {
                this.errors.phone = true;
                return false;
            }
            let new_phone = `${this.form.code}${this.form.phone}`;
            const confirm_phone = parsePhoneNumberFromString(new_phone);
            if (confirm_phone.isValid()) {
                this.form.phoneList.push(confirm_phone.number);
                this.form.phone = "";
            } else {
                this.errors.phone = false;
            }
        },
        sendMessage() {
            console.log(this.form);
            if (!this.form.message) {
                this.errors.message = true;
                return false;
            }

            // send message
            this.$store.dispatch("Message/sendMessage", {
                phoneList: this.form.phoneList,
                message: this.form.message,
            });

            call("post", endpoints.sendMessage, {
                phoneList: this.form.phoneList,
                message: this.form.message,
            }).then((res) => {
                console.log(res);
            });
            this.form.phoneList = [];
            this.form.message = "";
        },
    },
};
</script>

<style scoped></style>
