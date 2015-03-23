---
title: ZgPHP: Marin Crnković - SaltStack
vimeo_id: 122843434
image: http://i.vimeocdn.com/video/511968385_640.jpg
---

[Marin Crnković](http://blog.anorgan.com/) from [web.burza](http://web.burza.hr/) will 
introduce us to [SaltStack](http://saltstack.com/) - provisioning system that looks to stir some fun in field 
traditionally owned by [Chef](https://www.chef.io/chef/), [Puppet](https://puppetlabs.com/) and 
[Ansible](http://www.ansible.com/home). Enter SaltStack, the remote execution, configuration management system 
that uses YAML files (psst, they are in fact Twig!). This talk will provide a crash course on the basics of Salt 
with some examples and use cases and to get you from "I install my software by hand" to "I used to install by hand, 
but now I love my life".

[Slides for this talk](https://slides.com/marincrnkovic/saltstack-1)

## Transcript (kinda)
### The problem and the solution
Hi, my name is Marin Crnković, I am a developer with over 10 years of experience and am currently working at web.burza.

We had this problem: we are working on one single development server, which means that from time to time we step on each other toes. What happens is, one guy opens a file, the other guy opens the same file and whoever saves and closes first, is a loser.

What can we do to solve that problem? Best thing to do is to set up local environment using virtual machines, and configure them for each project. For creating virtual machines we use [Vagrant](https://www.vagrantup.com/), which is a tool to build an appliance for VirtualBox (amongst others), and it gives us a default, tabula rasa machine. Next we need to configure that machine with all the needed packages and configuration to run a certain app.

So, how does one do that? Well, you could SSH into your box, run a couple of commands, edit a couple of files, than run some more commands, than edit some more files. By the time you are running files and editing commands, you start to look for some better solution. We developers tend to automate things, so why not automate setting up the server, which is called provisioning.

Lets take a look at the solutions that are available. We have [Puppet](https://puppetlabs.com/) which came in 2005, is written in Ruby and has a strong community. Puppet is the first provisioning system I started to use but didn’t like the verbose and unreadable configuration that you also write in Ruby. Also, its documentation could be better.

After Puppet came [Chef](https://www.chef.io/), arround 2009. It is also written in Ruby, so configuration is in Ruby. I haven’t used it, but from what I saw, the documentation is really good, and it is easy to get started.

In 2011 came [Saltstack](http://saltstack.com/), what we’re gonna talk about in this presentation, and a year later came [Ansible](http://www.ansible.com/home). Both are written in Python, and Ansible differs from the other three by being agentless, that is to say, no software is needed to be installed on the server we’re configuring. It has great documentation, and its configuration (Playbook) is written in YAML and is also using Jinja for configuration templates - same as SaltStack.

### Saltstack - what is it made of?
Ok, now that we know the major players in this field, lets take a closer look at SaltStack. 

* Saltstack is comprised of a main server that is communicating with all servers we’re configuring. That server is called “Master”
* All the other servers are called “Minions”
* Execution modules are the heart of Saltstack - those guys actually run stuff. There are a lot of modules, for example, modules for installing packages, running commands, configuring apache, running composer, and even running puppet or chef configuration
* State modules describe what state those execution modules must create
* Pillars provide variables for states
* Grains provide information about Minions

Yes, a lot to grasp, so let’s take deeper look at each of these.

**Master** server keeps states, pillars and top files. It talks to Minions via ZeroMQ, SSH or, RAET. ZeroMQ is the default message transport and there is going to be a talk next month here at ZgPHP about it, which I’m looking forward to, so I won’t go into detail. SSH is good for talking to systems where you can not install the agent, for example routers, printers and such. RAET (**R**eliable **A**synchronous **E**vent **T**ransport) is still in early development and is developed because of licensing and cryptography issues / improvements, but also because of even greater speed. Interesting fact, it is developed as a standalone module and can be used independently.

**Minions** provide information about themselves (Grains), they listen for commands that the Master sends and execute modules.

**Top files** are configuration files that provide structure for pillars and states; they tell Master what states or pillars need to be sent to what Minion for each of the environment.

**State files** describe a set of desired states that a system needs to be in, for example “apache needs to be installed and running”.

**Pillars** are a set of variables that are used in state files. For example, apache on redhat based distributions is named httpd, while on debian based it is named apache2. It is nice to be able to put that name in a variable so state configuration is agnostic to the name of packages.

Lastly, we have **Grains**, which are sets of variables provided by the Minions. Grains provide us with information like the operating system name and family, disk and memory usage, number of CPU cores and so on.

### Configuration
Configuration is YAML, which is great, but at first configuration files are written in Jinja templating language, which is even greater because that gives us the support of conditional statements, for loops and variables. And Jinja is for Python what Twig is for PHP, so if you have worked with Twig templating language, guess what: you already know SaltStack!

There are other ways to write the configuration: for example, you can use JSON instead of YAML, or even add another templating engine: Jinja - Wempy - YAML. You can write Python DSL, or even plain Python. Best part: XML is not supported! Go, SaltStack!

### Conclusion
To wrap it up, lets see what is possible when using SaltStack. You can install and configure packages, start and stop services, execute commands on remote servers. You can set up servers in all major clouds, such as AWS, Linode, DigitalOcean, Rackspace and others.

Furthermore, since configuration is just a bunch of files, you can version them with git and roll back your server to any previous state. You can even fork server configuration (https://github.com/saltstack-formulas)

Thank you.

* http://saltstack.com
* http://docs.saltstack.com/en/latest/index.html
* https://github.com/saltstack/salt-bootstrap
