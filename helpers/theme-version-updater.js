module.exports.readVersion = function (contents) {
    console.log('read file', contents.slice(0));
    const version = contents.match(/(?<=Version:\s+)(\d+\.\d+\.\d+)/g)[0];
    console.log('return version', version);
    return version;
  };

  module.exports.writeVersion = function (contents, version) {
    console.log('write file', contents.slice(0));
    return contents.replace(/(?<=Version:\s+)(\d+\.\d+\.\d+)/g, () => {
      console.log('replace version with', version);
      return version;
    });
  };
