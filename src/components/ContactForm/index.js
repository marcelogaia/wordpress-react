import React, { Component } from "react";
import "./ContactForm.css";

class ContactForm extends Component {
    render() {
        return (
            <div className="ContactForm">
                <form>
					<input type="text" placeholder="Your name" />
					<input type="text" placeholder="Your e-mail" />
					<input type="text" placeholder="Your phone number" />
					<textarea placeholder="What's your problem?"></textarea>
					<button>Send</button>
				</form>
            </div>
        );
    }
}

export default ContactForm;