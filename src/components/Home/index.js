import React, { Component } from 'react';
import './Home.css';
import Section from "./Section";
import Header from "../Header";
import Footer from "../Footer";
import Banner from "./Banner";
import About from "./About";
import Timeline from "./Timeline";
import Skills from "./Skills";
import Projects from "./Projects";
import Testimonials from './Testimonials';
import Contact from './Contact';

class Home extends Component {
  render() {
    return (
      <div className="Home">
        <Header />
        <Banner />
        
        <Section title="About me" name="about" className="gray">
          <About />
          <Timeline />
        </Section>
        
        <Section title="Latest Projects" name="projects">
          <Projects />
        </Section>
        
        <Section title="Skills" name="skills" className="gray">
          <Skills />
        </Section>
        
        <Section title="Testimonials" name="testimonials">
          <Testimonials />
        </Section>
        
        <Section title="Keep in touch" name="contact" className="gray">
          <Contact />
        </Section>

        <Footer />
      </div>
    );
  }
}

export default Home;
