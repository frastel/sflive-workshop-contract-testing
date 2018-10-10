# -*- mode: ruby -*-
# vi: set ft=ruby :

Vagrant.configure(2) do |config|
  # vm settings
  config.vm.box = "ubuntu/bionic64"
  config.vm.box_check_update = false
  config.vm.network "private_network", ip: "192.168.33.10"
  config.vm.synced_folder "./", "/vagrant"

  # ssh settings
  #config.ssh.insert_key = false
  config.ssh.forward_agent = true

  # virtualbox settings
  config.vm.provider "virtualbox" do |vb|
    # Display the VirtualBox GUI when booting the machine
    vb.gui = false
    vb.name = "workshop"

    # Customize the amount of memory on the VM:
    vb.memory = "4096"
  end

  config.vm.provision :shell, path: "bin/provision.sh"

end
