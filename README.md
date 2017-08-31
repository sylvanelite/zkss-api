# ZKSS-API

Simple API for message passing over HTTP.

  - init - returns ID of the top message
  - getUpdates - GET
  -- query string: uid,area,mid
  -- returns: <root><m><id>id</id><t>message</t></m></root>
  - setUpdates -GET
  -- query string: uid,area,message
  - kvs_load - POST
  -- data_key, returns data_value
  - kvs_save - POST
  -- data_key, data_value - does insert or update for key

