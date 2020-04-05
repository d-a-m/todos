<template>
    <div class="accordion">
        <span @click="toggle" class="add-link">
            <slot name="link-content"></slot> <span class="arrow-direction arrow inline-block down">›</span>
        </span>

        <transition name="accordion" v-on:before-enter="beforeEnter" v-on:enter="enter" v-on:before-leave="beforeLeave" v-on:leave="leave">
            <div class="body" v-show="show">
                <div class="body-inner">
                    <slot></slot>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    export default {
        name: "Accordion",

        data: function () {
            return {
                show: false
            };
        },

        methods: {
            toggle: function () {
                this.show = !this.show;

                let arrow = document.querySelector('.arrow-direction');

                if (this.show) {
                    arrow.classList.remove('down');
                    arrow.classList.add('up');
                } else {
                    arrow.classList.remove('up');
                    arrow.classList.add('down');
                }

            },
            beforeEnter: function (el) {
                el.style.height = '0';
            },
            enter: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            beforeLeave: function (el) {
                el.style.height = el.scrollHeight + 'px';
            },
            leave: function (el) {
                el.style.height = '0';
            }
        }
    }
</script>

<style scoped>
    .accordion {
        width: 100%;
    }

    .accordion .body {
        transition: 150ms ease-out;
    }

    .accordion .body-inner {
        padding-top: 8px;
        overflow-wrap: break-word;
    }

    .accordion .header-icon.rotate {
        transform: rotate(180deg);
        transition-duration: 0.3s;
    }

    .accordion .add-link {
        font-size: 12px;
        cursor: pointer;
    }

    .accordion .arrow {
        font-size: 16px;
        position: relative;
        top: 2px;
        left: 2px;
    }

    .arrow-direction.up {
        transform: rotate(-90deg);
    }

    .arrow-direction.down {
        transform: rotate(90deg);
        left: 4px;
    }
</style>