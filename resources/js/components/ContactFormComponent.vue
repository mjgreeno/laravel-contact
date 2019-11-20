<template>
    <form @submit.prevent="submit">
        <div class="form-group">
            <label for="name" class="sr-only" >Name:</label>
            <input type="text" class="form-control input-lg" name="name" id="name" placeholder="Enter Full Name" v-model="fields.name" />
            <div v-if="errors && errors.name" class="text-danger">{{ errors.name[0] }}</div>
        </div>
        <div class="form-group">
            <label for="email" class="sr-only">E-mail:</label>
            <input type="email" class="form-control input-lg" name="email" id="email" placeholder="Email ex:example@email.com" v-model="fields.email" />
            <div v-if="errors && errors.email" class="text-danger">{{ errors.email[0] }}</div>
        </div>
        <div class="form-group">
            <label for="phone" class="sr-only">Phone:</label>
            <input type="tel" class="form-control input-lg" name="phone" id="phone" pattern="[0-9]{3}[0-9]{3}[0-9]{4}" placeholder="Phone ex:5558675309 " v-model="fields.phone" />
            <div v-if="errors && errors.phone" class="text-danger">{{ errors.phone[0] }}</div>
        </div>
        <div class="form-group">
            <label for="inquiry" class="sr-only">Message:</label>
            <textarea class="form-control input-lg" id="inquiry" name="inquiry" rows="10" placeholder="Send us a message" v-model="fields.inquiry"></textarea>
            <div v-if="errors && errors.inquiry" class="text-danger">{{ errors.inquiry[0] }}</div>
        </div>

        <button type="submit" class="btn btn-default btn-lg">Send message</button>

        <div v-if="success" class="alert alert-success mt-3">
            Message sent!
        </div>
    </form>
</template>

<script>
    import FormMixin from '../FormMixin';
    export default {
        mixins: [ FormMixin ],
        data() {
            return {
                'action': '/submit',
            }
        }
    }
</script>