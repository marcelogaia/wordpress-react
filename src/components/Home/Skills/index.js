import React, { Component } from 'react';
import "./Skills.css";

class Skills extends Component {

    createList = () => {
        let skills = [
            "PHP", "Java", "Javascript", "HTML5", "CSS/SASS", // Languages
            "CodeIgniter", "Bootstrap", "jQuery", // Frameworks & Libraries
            "MySQL", "SQL Server.", //Databases
            "MVC", "Object-Orientated Programming", "Responsiveness", "Agile", // Concepts
            "Git/GitHub", "SVN", // Version Control
            "React JS", "Wordpress", "Node JS" // Learning
        ];

        let list = [];

        for(let i = 0; i < skills.length; i++) {
            list.push(<li><a href="javascript:void(0)">{skills[i]}</a></li>);
        }

        return list;
    }

	render() {
        
		return (
			<div className="Skills">
                <ul>
                {this.createList()}
                </ul>
			</div>
		);
	}
}

export default Skills;