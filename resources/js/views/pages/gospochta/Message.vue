<script>
import MessageService from "@/service/MessageService.js";

const messageService = new MessageService();

export default {
    name: "Message",
    data() {
        return {
            message: [],
        }
    },
    created() {
        this.getMessage()
    },
    watch: {
        $route: 'getMessage'
    },
    methods: {
        getMessage() {
            messageService.getMessage(this.$route.params.sender, this.$route.params.message).then((data) => (this.message = data));
        }
    }
}
</script>

<template>
    <Toast />
    <div className="card ">
        <div class="massage">
            <div class="massage__header">
                <h2>{{ message.title }}</h2>
            </div>
            <p class="massage__header-sender">Отправитель: <span>{{ message.sender.title }}</span></p>
            <div v-if="message.subject !== null" class="massage__info mt-5" v-html=" message.subject.split('\\').join('')"></div>
            <div v-if="message.files.length > 0" class="massage__file mt-5">
                <div class="card__docs">
                    <p class="card-text card-text-bold">Документы</p>
                    <ul class="card__docs-list">

                        <li v-for="file in message.files" :key="file.id" class="card__docs-item">
                            <a class="card__docs-item-link" :href="'/api/download-file/' + file.id">
                                <span class="card__docs-item-left card-text">
                                    <span class="icon-file icon-file-PDF">PDF</span>
                                    <span class="card__docs-item-left-file">{{ file.original_name }}</span>
                                </span>
                                <span class="card__docs-item-right card-link">Скачать</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped lang="scss">
    .massage {
        &__header {
            &-sender {
                font-size: 18px;
            }
        }
    }

    .icon-file-PDF {
        background: #de772a;
    }

    .icon-file {
        margin-left: 15px;
        padding: 0 3px 0 0;
        border-radius: 4px;
        color: #fff;
        font-size: 14px;
        line-height: 23px;
        position: relative;
        z-index: 1;
    }

    .card {
        background: #ffffff;
        box-shadow: 0 1px 4px #e3ebfc, 0 24px 48px #e6ebf566;
        border-radius: 16px;
        padding: 24px;

        &__header {
            display: flex;
            flex-direction: column;

            &-top {
                display: flex;
                justify-content: space-between;

                &-title {
                    cursor: pointer;
                    margin-right: 40px;
                    font-size: 18px;
                    font-weight: 700;
                    font-style: normal;
                    line-height: 24px;
                    color: #0b1f33;
                }
            }

            &-bottom {
                margin-top: 8px;

                &-text {
                    font-size: 16px;
                    line-height: 24px;
                    color: #66727f;
                }

                &-info {
                    margin-top: 20px;
                    display: flex;
                    column-gap: 16px;
                    align-items: center;

                    &-text {
                        padding: 0 8px;
                        border: 2px solid #99b1e6;
                        border-radius: 4px;
                    }
                }
            }
        }

        &__body {
            margin-top: 24px;

            &-mt {
                margin-top: 24px;
            }

            &-list {
                display: flex;
                flex-direction: column;
                row-gap: 12px;
            }

            p {
                margin-bottom: 8px;
                font-size: 16px;
                line-height: 24px;
                color: #0b1f33;

                a {
                    font-size: 16px;
                    line-height: 24px;
                    color: #0d4cd3;
                    transition: all .2s ease;

                    &:hover {
                        color: #1d5deb;
                    }
                }
            }

            a {
                font-size: 16px;
                line-height: 24px;
                color: #0d4cd3;
                transition: all .2s ease;

                &:hover {
                    color: #1d5deb;
                }
            }
        }

        &__info {
            margin-top: 24px;
            background-color: #EDF2FE;
            padding: 20px;
            border-radius: 8px;
        }

        &-text {
            margin-bottom: 8px;
            font-size: 16px;
            line-height: 24px;
            color: #0b1f33;

            &-mt {
                margin-top: 12px;
            }

            &-bold {
                font-weight: 700;
            }
        }

        &-link {
            font-size: 16px;
            line-height: 24px;
            color: #0d4cd3;
            transition: all .2s ease;

            &:hover {
                color: #1d5deb;
            }
        }

        &__docs {
            margin-top: 24px;
            background-color: #f5f7fa;
            padding: 20px;
            border-radius: 8px;

            &-list {
                margin: 24px 0 0 0;
                padding: 0 0 16px 0;
                display: flex;
                flex-direction: column;
                row-gap: 24px;
            }

            &-item {
                list-style-type: none;
                margin: 0;
                padding: 0;
                &-link {
                    display: flex;
                    justify-content: space-between;
                    align-items: center;
                    width: 100%;
                }

                &-left {
                    display: flex;
                    column-gap: 12px;
                    align-items: center;
                }
            }
        }
    }

    .icon-file {
        margin-left: 15px;
        padding: 0px 3px 0px 0px;
        border-radius: 4px;
        color: #fff;
        font-size: 14px;
        line-height: 23px;
        position: relative;
        z-index: 1;

        &:before, {
            background: inherit;
            content: '';
            display: block;
            height: 100%;
            left: 0;
            position: absolute;
            right: 0;
            z-index: -1;
            -webkit-backface-visibility: hidden; // for Chrome Windows
        }

        &:before {
            border-radius: 6px;
            transform: skewX(-34deg);
            transform-origin: 100% 0;
        }
        &-PDF {
            background: #de772a;
        }

        &-XML {
            background: #27ef84;
        }

        &-ZIP {
            background: #973df6;
        }

        &-SIG {
            background: #8b8b8c;
        }

        &-HTML {
            background: #6969fa;
        }
    }

</style>
