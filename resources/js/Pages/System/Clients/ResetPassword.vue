<template>
    <el-dialog
        :title="titleDialog"
        :visible="showDialog"
        @close="close"
        @open="create"
    >
        <el-form :model="form" :ref="formName" autocomplete="off">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div
                            class="form-group"
                            :class="{ 'has-danger': errors.password }"
                        >
                            <el-form-item
                                label="Contraseña"
                                prop="password"
                                :rules="rules.password"
                            >
                                <el-input
                                    v-model="form.password"
                                    type="password"
                                    show-password
                                    required
                                    autocomplete="off"
                                ></el-input>
                            </el-form-item>

                            <small
                                class="form-control-feedback"
                                v-if="errors.password"
                                v-text="errors.password[0]"
                            ></small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div
                            class="form-group"
                            :class="{
                                'has-danger': errors.password_confirmation
                            }"
                        >
                            <el-form-item
                                label="Repetir Contraseña"
                                prop="password_confirmation"
                                :rules="rules.password_confirmation"
                            >
                                <el-input
                                    v-model="form.password_confirmation"
                                    type="password"
                                    show-password
                                    required
                                    autocomplete="off"
                                ></el-input>
                            </el-form-item>
                            <small
                                class="form-control-feedback"
                                v-if="errors.password_confirmation"
                                v-text="errors.password_confirmation[0]"
                            ></small>
                        </div>
                    </div>
                </div>
            </div>
        </el-form>
        <span slot="footer" class="dialog-footer">
            <div class="form-actions text-right pt-2">
                <el-button @click.prevent="close()">Cancelar</el-button>
                <el-button
                    type="primary"
                    @click.prevent="submit(formName)"
                    :loading="loading_submit"
                    dusk="submit"
                >
                    <template v-if="loading_submit">
                        Cambiando contraseñas de todos los Clientes...
                    </template>
                    <template v-else>
                        Aceptar
                    </template>
                </el-button>
            </div>
        </span>
    </el-dialog>
</template>
<style>
.el-form-item--small .el-form-item__label {
    font-size: inherit;
    line-height: inherit;
}
</style>
<script>
import { serviceNumber } from "@/js/utilities/mixins/functions";

export default {
    mixins: [serviceNumber],
    props: ["showDialog", "recordId"],
    data() {
        var validatePass2 = (rule, value, callback) => {
            if (value === "") {
                callback(
                    new Error("Ingrese el password_confirmation nuevamente.")
                );
            } else if (value !== this.form.password) {
                callback(
                    new Error(
                        "El campo password_confirmation no coincide con password."
                    )
                );
            } else {
                callback();
            }
        };
        return {
            loading_submit: false,
            loading_search: false,
            titleDialog: null,
            resource: "clients",
            error: {},
            form: {},
            formName: "validateForm",
            url_base: null,
            plans: [],
            rules: {
                password: [
                    {
                        required: true,
                        message: "El campo password es obligatorio."
                    }
                ],
                password_confirmation: [
                    {
                        required: true,
                        message:
                            "El campo password_confirmation es obligatorio."
                    },
                    {
                        validator: validatePass2,
                        trigger: "blur"
                    }
                ]
            }
        };
    },
    created() {
        this.initForm();
    },
    methods: {
        initForm() {
            this.errors = {};
            this.form = {
                password: null,
                repeat_password: null
            };
        },
        create() {
            this.titleDialog = "Resetear Clave Masivo";
        },
        submit(formName) {
            this.$refs[formName].validate(valid => {
                if (valid) {
                    this.loading_submit = true;
                    this.$http
                        .post(
                            `${this.resource}/reset_password_massive`,
                            this.form
                        )
                        .then(response => {
                            if (response.data.success) {
                                this.$message.success(response.data.message);
                                this.$eventHub.$emit("reloadData");
                                this.close();
                            } else {
                                this.$message.error(response.data.message);
                            }
                        })
                        .catch(error => {
                            if (error.response.status === 422) {
                                this.errors = error.response.data;
                            } else {
                                console.log(error.response);
                            }
                        })
                        .then(() => {
                            this.loading_submit = false;
                        });
                } else {
                    return false;
                }
            });
        },
        close() {
            this.$refs[this.formName].resetFields();
            this.$emit("update:showDialog", false);
            this.initForm();
        }
    }
};
</script>
