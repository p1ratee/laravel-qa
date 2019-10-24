<template>
  <div class="media post">
    <vote-c :model="answer" name="answer"></vote-c>
    <div class="media-body">
      <form v-if="editing" @submit.prevent="update">
        <div class="form-group">
          <textarea class="form-control" v-model="body" rows="10" required></textarea>
        </div>
        <button class="btn btn-lg btn-outline-secondary" :disabled="isInvalid">Update</button>
        <button class="btn btn-lg btn-outline-primary" @click="cancel" type="button">Cancel</button>
      </form>
      <div v-else>
        <div v-html="bodyHtml"></div>
        <div class="row">
          <div class="col-4">
            <div class="ml-auto">
              <a
                v-if="authorize('modify',answer)"
                @click.prevent="edit"
                class="btn btn-sm btn-outline-info"
              >Edit</a>
              <button
                v-if="authorize('modify',answer)"
                @click="destroy"
                class="btn btn-sm btn-outline-danger"
              >Delete</button>
            </div>
          </div>
        </div>
        <div class="col-4"></div>
        <div class="col-4 float-right">
          <user-info :model="answer" label="Answered"></user-info>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["answer"],
  data() {
    return {
      editing: false,
      body: this.answer.body,
      bodyHtml: this.answer.body_html,
      id: this.answer.id,
      questionId: this.answer.question_id,
      beforeEditCache: null
    };
  },
  methods: {
    edit() {
      this.beforeEditCache = this.body;
      this.editing = true;
    },
    cancel() {
      this.body = this.beforeEditCache;
      this.editing = false;
    },
    update() {
      axios
        .patch(this.endpoint, {
          body: this.body
        })
        .then(res => {
          this.editing = false;
          this.bodyHtml = res.data.body_html;
          this.$toast.success(res.data.message, "Success", { timeout: 3000 });
        })
        .catch(err => {
          this.$toast.success(err.response.data.message, "Error", {
            timeout: 3000
          });
        });
    },
    destroy() {
      if (confirm("Are you sure?")) {
        axios
          .delete(this.endpoint)
          .then(res => {
            $(this.$el).fadeOut(500, () => {
              this.$toast.success(res.data.message, "Success", {
                timeout: 3000
              });
            });
          })
          .catch();
      }
    }
  },
  computed: {
    isInvalid() {
      return this.body.length < 10;
    },
    endpoint() {
      return this.questionId + "/answers/" + this.id;
    }
  },
  mounted() {
    console.log(this.answer);
  }
};
</script>