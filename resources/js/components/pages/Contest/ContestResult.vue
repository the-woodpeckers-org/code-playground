<script>
import {HTTP} from "@/http-common.js";
import moment from "moment";

export default {
    name: "ContestResult",
    data: () => {
        return {
            participation: {},
            contest: {},
            attempts: [],
            finished_at: '',
            total_problems: 0,
            codeEditor: null
        }
    },
    mounted() {
        this.onload();
    },
    methods: {
        setCode(index) {
            this.codeEditor.setValue(this.attempts[index].code, 1);
        },
        onload() {
            this.codeEditor = ace.edit('code-editor')
            this.codeEditor.setTheme('ace/theme/monokai')
            this.codeEditor.session.setMode('ace/mode/c_cpp')
            this.codeEditor.setReadOnly(true);
            let _this = this;
            HTTP.get('api/contest/result?contest_id=' + this.$route.params.id)
                .then((response) => {
                    console.log(response);
                    _this.participation = response.data.participation;
                    _this.contest = response.data.participation.contest;
                    _this.attempts = response.data.attempts;
                    _this.finished_at = moment(response.data.finished_at).format('DD-MM-yyyy hh:mm:ss')
                    _this.total_problems = response.data.participation.problems.length;
                    _this.setCode(0);
                })
                .catch((err) => {

                });
        },
        format(d, h, m, s) {
            let cd = String(d), ch = String(h), cm = String(m), cs = String(s);
            if (cd.length == 1) {
                cd = '0' + cd;
            }
            if (ch.length == 1) {
                ch = '0' + ch;
            }
            if (cm.length == 1) {
                cm = '0' + cm;
            }
            if (cs.length == 1) {
                cs = '0' + cs;
            }
            return cd + 'd' + ' ' + ch + 'h' + ' ' + cm + 'm' + ' ' + cs + 's';
        }
    }
}
</script>

<template>
    <div class="w-full">
        <div class="bg-base-200 p-3 shadow-xl rounded-lg">
            <p class="text-xl font-semibold">Your result at {{ contest.title }}</p>
            <p>Start date: {{ contest.start_date }}</p>
            <p>End date: {{ contest.end_date }}</p>
            <div class="divider"></div>
            <p>You have finished at: <span class="font-semibold">{{ finished_at }}</span></p>
            <p>Finished time: {{format(participation.finishedTime?.days, participation.finishedTime?.hours, participation.finishedTime?.minutes, participation.finishedTime?.seconds)}}</p>
            <p>Problems solved: <span class="font-semibold">{{ participation.finished_problems + '/' + total_problems }}</span></p>
            <p>Your code: </p>
            <div role="tablist" class="tabs tabs-lifted m-0">
                <template v-for="(attempt, index) in attempts">
                    <input type="radio" name="my_tabs_2" role="tab" class="tab" :ariaLabel="'Problem ' + (index + 1)" :checked="index === 0" @click="setCode(index)"/>
                    <div role="tabpanel" class="tab-content">
                    </div>
                </template>
            </div>
            <div class="bg-base-100 border-base-300 py-2">
                <div id="code-editor" style="width: 95%; height: 500px" class="text-base mt-3 mx-auto">

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
