import React, { Component } from "react";
import "./ContactForm.css";

class ContactForm extends Component {
    render() {
        return (
            <div className="ContactForm">
                <form method="post" action="#">
					<input type="text" name="name" placeholder="Your name" />
					<input type="email" name="email" placeholder="Your e-mail" />
					<input type="phone" name="phone" placeholder="Your phone number" />
					<textarea name="message" placeholder="What's your problem?"></textarea>
					<button>Send</button>
				</form>
            </div>
        );
    }
}

export default ContactForm;